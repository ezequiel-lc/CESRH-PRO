<?php

namespace App\Livewire\PortalRh\Trabajador;

use Livewire\Component;
use App\Models\PortalRH\Trabajador;

class MostrarTrabajador extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $trabajadorToDelete; // ID de la sucursal a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregartrabajador');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->trabajadorToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteTrabajador()
    {
        if ($this->trabajadorToDelete) {
            Trabajador::find($this->trabajadorToDelete)->delete();
            session()->flash('message', 'Trabajador eliminado exitosamente.');
        }

        $this->trabajadorToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrartrabajador');
    }

    public function render()
    {
        return view('livewire.portal-rh.trabajador.mostrar-trabajador')->layout('layouts.client');
    }
}
