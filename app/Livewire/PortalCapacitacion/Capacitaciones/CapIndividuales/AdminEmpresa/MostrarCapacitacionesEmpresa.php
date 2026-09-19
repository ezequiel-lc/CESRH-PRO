<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminEmpresa;

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

class MostrarCapacitacionesEmpresa extends Component
{
    use WithPagination;

    public $usuario_id;
    public $user;
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;
    public $years = [];
    public $selectedYear = null; 

    public function mount($id)
    {
        $this->usuario_id = Crypt::decrypt($id);
        $this->user = User::find($this->usuario_id);

        // Cargar años disponibles desde la BD
        $this->loadAvailableYears();
    }

    public function loadAvailableYears()
    {
        $this->years = CapacitacionIndividual::whereHas('usuarios', function ($query) {
                $query->where('users.id', $this->usuario_id);
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

        return redirect()->route('verCapacitacionesInd', ['id' => $this->usuario_id]); // Redirigir después de eliminar
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
                $query->where('users.id', $this->usuario_id);
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
        return view('livewire.portal-capacitacion.capacitaciones.cap-individuales.admin-empresa.mostrar-capacitaciones-empresa', [
            'capacitaciones' => $this->user 
                ? $this->user->capacitaciones()->with('curso')->paginate(3) 
                : collect(),
            'years' => $this->years,   // Años disponibles en la vista
            'selectedYear' => $this->selectedYear, // Variable corregida
        ])->layout("layouts.portal_capacitacion");
    }    

}
