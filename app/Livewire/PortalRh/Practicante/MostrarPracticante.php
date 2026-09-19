<?php

namespace App\Livewire\PortalRh\Practicante;

use Livewire\Component;
use App\Models\PortalRH\Practicante;

class MostrarPracticante extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $practicanteToDelete; // ID de la sucursal a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarpracticante');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->practicanteToDelete = $id;
        $this->showModal = true;
    }
    
    public function deletePracticante()
    {
        if ($this->practicanteToDelete) {
            Practicante::find($this->practicanteToDelete)->delete();
            session()->flash('message', 'Becario eliminado exitosamente.');
        }

        $this->practicanteToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarpracticante');
    }

    public function render()
    {
        return view('livewire.portal-rh.practicante.mostrar-practicante')->layout('layouts.client');
    }
}
