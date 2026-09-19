<?php

namespace App\Livewire\PortalRh\Retardos;

use Livewire\Component;
use App\Models\PortalRH\Retardo;

class MostrarRetardos extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $retardoToDelete; // ID a eliminar

    // Redirigir a una vista para agregar 
    public function redirigir()
    {
        return redirect()->route('agregarretardo');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->retardoToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteIncidencia()
    {
        if ($this->retardoToDelete) {
            Retardo::find($this->retardoToDelete)->delete();
            session()->flash('message', 'Retardo eliminado exitosamente.');
        }

        $this->retardoToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarretardo');
    }

    public function render()
    {
        return view('livewire.portal-rh.retardos.mostrar-retardos')->layout('layouts.client');
    }
}
