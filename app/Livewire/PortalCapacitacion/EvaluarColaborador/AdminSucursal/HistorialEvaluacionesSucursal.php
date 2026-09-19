<?php
namespace App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminSucursal;

use Livewire\Component;
use App\Models\User;
use App\Models\PortalCapacitacion\Evaluacion;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Instructor;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\DB;

class HistorialEvaluacionesSucursal extends Component
{
    public $userSeleccionado,$trabajador,
    $becario,
    $practicante,
    $instructor;
    public $orden = 'recientes';
    public $fechaSeleccionada;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $this->userSeleccionado = User::find($id);
        $this->fechaSeleccionada = null;
    }

    public function setFecha($fecha)
    {
        $this->fechaSeleccionada = $fecha;
    }

    public function obtenerHistorialEvaluaciones()
    {
        return Evaluacion::where('users_id', $this->userSeleccionado->id)
            ->with('perfilesPuestos')
            ->orderBy('fecha_evaluacion', $this->orden === 'recientes' ? 'desc' : 'asc')
            ->get()
            ->groupBy('fecha_evaluacion');
    }

    public function exportarPDF()
    {
        if (!$this->fechaSeleccionada) {
            return;
        }

        $evaluaciones = Evaluacion::where('users_id', $this->userSeleccionado->id)
            ->where('fecha_evaluacion', $this->fechaSeleccionada)
            ->with('perfilesPuestos')
            ->get();      

        $this->trabajador = Trabajador::where('user_id', $this->userSeleccionado->id)->first();
        $this->becario = Becario::where('user_id', $this->userSeleccionado->id)->first();
        $this->practicante = Practicante::where('user_id', $this->userSeleccionado->id)->first();
        $this->instructor= Instructor::where('user_id', $this->userSeleccionado->id)->first();
        $this->userSeleccionado = User::with('empresa')->find($this->userSeleccionado->id);
        $this->userSeleccionado = User::with('sucursal')->find($this->userSeleccionado->id);
        //$this->userSeleccionado = User::with('departamento')->find($this->userSeleccionado->id);
       
        $pdf = Pdf::setOptions(['dpi' => 150, 'isRemoteEnabled' => true])
            ->loadView('livewire.portal-capacitacion.evaluar-colaborador.pdf.evaluacion', [
                'evaluaciones' => $evaluaciones,
                'usuario' => $this->userSeleccionado,
                'fecha' => $this->fechaSeleccionada,
                'trabajador' => $this->trabajador,
                'becario' => $this->becario,
                'practicante' => $this->practicante,
                'instructor' => $this->instructor,
    
        ])->setPaper('A4', 'portrait');
        

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "evaluacion_{$this->fechaSeleccionada}.pdf");
    }

    public function exportarTodasPDF()
    {
        $evaluaciones = $this->obtenerHistorialEvaluaciones();

        $this->trabajador = Trabajador::where('user_id', $this->userSeleccionado->id)->first();
        $this->becario = Becario::where('user_id', $this->userSeleccionado->id)->first();
        $this->practicante = Practicante::where('user_id', $this->userSeleccionado->id)->first();
        $this->instructor= Instructor::where('user_id', $this->userSeleccionado->id)->first();
        $this->userSeleccionado = User::with('empresa')->find($this->userSeleccionado->id);
        $this->userSeleccionado = User::with('sucursal')->find($this->userSeleccionado->id);
        $this->practicante = Practicante::with('departamento')->where('user_id', $this->userSeleccionado->id)->first();

        $pdf = Pdf::setOptions(['dpi' => 150, 'isRemoteEnabled' => true])->loadView('livewire.portal-capacitacion.evaluar-colaborador.pdf.evaluaciones-todas', [
            'evaluaciones' => $evaluaciones,
            'usuario' => $this->userSeleccionado,
            'fecha' => $this->fechaSeleccionada,
            'trabajador' => $this->trabajador,
            'becario' => $this->becario,
            'practicante' => $this->practicante,
            'instructor' => $this->instructor,
        ])->setPaper('A4', 'portrait');;

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "historial_evaluaciones.pdf");
    }

    public function render()
    {
        $evaluacionesAgrupadas = $this->obtenerHistorialEvaluaciones();
        $fechasDisponibles = $evaluacionesAgrupadas->keys();
        $evaluaciones = $this->fechaSeleccionada ? $evaluacionesAgrupadas[$this->fechaSeleccionada] ?? collect() : collect();

        return view('livewire.portal-capacitacion.evaluar-colaborador.admin-sucursal.historial-evaluaciones-sucursal', [
            'fechas' => $fechasDisponibles,
            'evaluaciones' => $evaluaciones,
        ])->layout("layouts.portal_capacitacion");
    }
}