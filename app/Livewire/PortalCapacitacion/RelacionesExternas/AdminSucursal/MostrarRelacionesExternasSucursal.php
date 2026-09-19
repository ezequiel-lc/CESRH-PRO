<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesExternasSucursal extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesExternasSucursal');
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
            RelacionExterna::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Relación externa eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarRelacionesExternasSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-sucursal.mostrar-relaciones-externas-sucursal')->layout("layouts.portal_capacitacion");
    }
}