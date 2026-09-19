<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class MostrarResponsabilidadesUniversalesSucursal extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarResponsabilidadesUniversalesSucursal');
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

        return redirect()->route('mostrarResponsabilidadesUniversalesSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-sucursal.mostrar-responsabilidades-universales-sucursal')->layout("layouts.portal_capacitacion");
    }
}