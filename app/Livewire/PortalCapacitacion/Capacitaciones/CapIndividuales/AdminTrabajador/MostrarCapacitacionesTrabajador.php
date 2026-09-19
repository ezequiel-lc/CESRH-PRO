<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminTrabajador;

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

class MostrarCapacitacionesTrabajador extends Component
{
    use WithPagination;

    public $userSeleccionado;
    public $user;
    public $years = [];
    public $selectedYear = null; 
    

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

    public function exportarPDF($id)
    {
        $capacitacion = CapacitacionIndividual::with('curso')->find($id);

        if (!$capacitacion) {
            session()->flash('error', 'Capacitación no encontrada.');
            return;
        }

        $pdf = Pdf::loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitaciones', compact('capacitacion'));
        
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'Capacitacion_' . $capacitacion->id . '.pdf'
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
                $query->where('users.id', $this->userSeleccionado);
            })
            ->whereYear('fechaIni', $this->selectedYear)
            ->with('curso')
            ->get();
    
        // Verificar si hay datos
        if ($capacitaciones->isEmpty()) {
            session()->flash('error', 'No hay capacitaciones disponibles para el año seleccionado.');
            return;
        }
    
        // Generar PDF
        $pdf = Pdf::loadView('livewire.portal-capacitacion.capacitaciones.pdf.capacitaciones-todas', [
            'capacitaciones' => $capacitaciones,
            'selectedYear' => $this->selectedYear, // Ahora sí está definida
        ]);
    
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "capacitaciones_{$this->selectedYear}.pdf"
        );
    }    

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-individuales.admin-trabajador.mostrar-capacitaciones-trabajador', [
            'capacitaciones' => $this->user 
                ? $this->user->capacitaciones()->with('curso')->paginate(3) 
                : collect(),
            'years' => $this->years,   // Años disponibles en la vista
            'selectedYear' => $this->selectedYear, // Variable corregida
        ])->layout("layouts.portal_capacitacion");
    }    

}
