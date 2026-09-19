<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral;

use Livewire\Component;
use App\Models\User;
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
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;

class MostrarCapacitacionesGrupalesGeneral extends Component
{
    public $userSeleccionado;
    public $user;
    public $capacitaciones;
    public $years = [];
    public $selectedYear = null; 
    public $trabajador,
        $becario,
        $practicante,
        $instructor;

    public function mount($id)
    {
        $this->userSeleccionado = Crypt::decrypt($id);
        $this->user = User::find($this->userSeleccionado);
        $this->capacitaciones = $this->user->capacitacionesGrupales; // Obtiene las capacitaciones

        $this->loadAvailableYears();
    }

    public function loadAvailableYears()
    {
        $this->years = GrupocursoCapacitacion::whereHas('participantes', function ($query) {
                $query->whereHas('users', function ($subQuery) {
                    $subQuery->where('users.id', $this->userSeleccionado);
                });
            })
            ->selectRaw('YEAR(fechaIni) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    public function exportarTodasCapacitaciones()
{
    // Verificar si el usuario seleccionó un año
    if (!$this->selectedYear) {
        session()->flash('error', 'Debes seleccionar un año antes de exportar.');
        return;
    }

    // Obtener capacitaciones grupales del usuario filtradas por año seleccionado
    $capacitaciones = GrupocursoCapacitacion::whereHas('participantes', function ($query) {
            $query->whereHas('users', function ($subQuery) {
                $subQuery->where('users.id', $this->userSeleccionado);
            });
        })
        ->whereYear('fechaIni', $this->selectedYear) // Filtrar por año
        ->with('curso') // Cargar relación con curso
        ->get();

    // Verificar si hay datos
    if ($capacitaciones->isEmpty()) {
        session()->flash('error', 'No hay capacitaciones disponibles para el año seleccionado.');
        return;
    }

    $this->trabajador = Trabajador::where('user_id', $this->user->id)->first();
    $this->becario = Becario::where('user_id', $this->user->id)->first();
    $this->practicante = Practicante::where('user_id', $this->user->id)->first();
    $this->instructor = Instructor::where('user_id', $this->user->id)->first();
    $this->user = User::with(['empresa', 'sucursal'])->find($this->user->id);
    
    $pdf = Pdf::setOptions(['dpi' => 150, 'isRemoteEnabled' => true])
        ->loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitaciones-todas-grupales', [
            'capacitaciones' => $capacitaciones,
            'selectedYear' => $this->selectedYear,
            'usuario' => $this->user,
            'trabajador' => $this->trabajador,
            'becario' => $this->becario,
            'practicante' => $this->practicante,
            'instructor' => $this->instructor,
        ])->setPaper('A4', 'portrait');

    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->stream();
    }, "Capacitaciones_Grupales_{$this->selectedYear}.pdf"
    );
}

    
    public function exportarPDF($id)
    {
        $capacitacion = GrupocursoCapacitacion::with('curso')->find($id);

        $this->trabajador = Trabajador::where('user_id', $this->user->id)->first();
        $this->becario = Becario::where('user_id', $this->user->id)->first();
        $this->practicante = Practicante::where('user_id', $this->user->id)->first();
        $this->instructor = Instructor::where('user_id', $this->user->id)->first();
        $this->user = User::with(['empresa', 'sucursal'])->find($this->user->id);
        
        $pdf = Pdf::setOptions(['dpi' => 150, 'isRemoteEnabled' => true])
            ->loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitacionesGrupales', [
                'capacitacion' => $capacitacion,
                'curso' => $capacitacion->curso,
                'usuario' => $this->user,
                'trabajador' => $this->trabajador,
                'becario' => $this->becario,
                'practicante' => $this->practicante,
                'instructor' => $this->instructor,
            ])->setPaper('A4', 'portrait');
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "Capacitacion_Grupal.pdf"
        );
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-general.mostrar-capacitaciones-grupales-general', [
            'capacitaciones' => $this->capacitaciones
        ])->layout("layouts.portal_capacitacion");
    }
}
