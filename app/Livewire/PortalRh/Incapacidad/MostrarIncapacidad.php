<?php

namespace App\Livewire\PortalRh\Incapacidad;

use Livewire\Component;
use App\Models\PortalRh\Incapacidad;

class MostrarIncapacidad extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $incapacidadToDelete; // ID a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarincapacidad');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->incapacidadToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteIncapacidad()
    {
        if ($this->incapacidadToDelete) {
            Incapacidad::find($this->incapacidadToDelete)->delete();
            session()->flash('message', 'Incapacidad eliminada exitosamente.');
        }

        $this->incapacidadToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarincapacidad');
    }

    public function render()
    {
        return view('livewire.portal-rh.incapacidad.mostrar-incapacidad')->layout('layouts.client');
    }
}
