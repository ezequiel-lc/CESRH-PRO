<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class MostrarResponsabilidadesUniversales extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarResponsabilidadesUniversales');
    }

    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->funcionToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteFuncion()
    {
        if ($this->funcionToDelete) {
            ResponsabilidadUniversal::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Responsabilidad Universal eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarResponsabilidadesUniversales');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-general.mostrar-responsabilidades-universales')->layout("layouts.portal_capacitacion");
    }
}