<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesInternasSucursal extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesInternasSucursal');
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
            RelacionInterna::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Relacion Interna eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarRelacionesInternasSucursal');
    }
    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-sucursal.mostrar-relaciones-internas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
