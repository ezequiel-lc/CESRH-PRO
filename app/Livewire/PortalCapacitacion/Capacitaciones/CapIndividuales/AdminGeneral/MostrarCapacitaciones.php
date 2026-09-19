<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminGeneral;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Instructor;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalCapacitacion\CapacitacionIndividual;

class MostrarCapacitaciones extends Component
{
    use WithPagination;

    public $userSeleccionado;
    public $user;
    public $showModal = false; 
    public $funcionToDelete;
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

        // Cargar años disponibles desde la BD
        $this->loadAvailableYears();
    }

    public function loadAvailableYears()
    {
        $this->years = CapacitacionIndividual::whereHas('usuarios', function ($query) {
                $query->where('users.id', $this->userSeleccionado);
            })
            ->selectRaw('YEAR(fechaIni) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->funcionToDelete = $id;
        $this->showModal = true; // Mostrar modal
    }

    public function deleteFuncion()
    {
        if ($this->funcionToDelete) {
            // Eliminar capacitación
            CapacitacionIndividual::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Capacitación eliminada con éxito');
        }

        // Restablecer el estado
        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('verCapacitacionesInd', ['id' => $this->userSeleccionado]); // Redirigir después de eliminar
    }

    public function exportarPDF($id)
    {
        $capacitacion = CapacitacionIndividual::with('curso')->find($id);

        $this->trabajador = Trabajador::where('user_id', $this->user->id)->first();
        $this->becario = Becario::where('user_id', $this->user->id)->first();
        $this->practicante = Practicante::where('user_id', $this->user->id)->first();
        $this->instructor = Instructor::where('user_id', $this->user->id)->first();
        $this->user = User::with(['empresa', 'sucursal'])->find($this->user->id);
        
        $pdf = Pdf::setOptions(['dpi' => 150, 'isRemoteEnabled' => true])
            ->loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitaciones', [
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
        }, "Capacitacion_Individual.pdf"
        );
    }

    public function exportarTodasCapacitaciones()
    {
        // Verificar si el usuario seleccionó un año
        if (!$this->selectedYear) {
            session()->flash('error', 'Debes seleccionar un año antes de exportar.');
            return;
        }

        // Obtener capacitaciones del usuario filtradas por año seleccionado
        $capacitaciones = CapacitacionIndividual::whereHas('usuarios', function ($query) {
                $query->where('users.id', $this->userSeleccionado); // Cambiado a userSeleccionado
            })
            ->whereYear('fechaIni', $this->selectedYear)
            ->with('curso')
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
            ->loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitaciones-todas', [
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
            }, "Capacitaciones_Individuales_{$this->selectedYear}.pdf"
        );
    }

    

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-individuales.admin-general.mostrar-capacitaciones', [
            'capacitaciones' => $this->user 
                ? $this->user->capacitaciones()->with('curso')->paginate(10) 
                : collect(),
            'years' => $this->years,   // Años disponibles en la vista
            'selectedYear' => $this->selectedYear, // Variable corregida
        ])->layout("layouts.portal_capacitacion");
    }    

}
