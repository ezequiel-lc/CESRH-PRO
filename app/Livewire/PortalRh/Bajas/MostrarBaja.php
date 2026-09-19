<?php

namespace App\Livewire\PortalRh\Bajas;

use Livewire\Component;
use App\Models\PortalRH\Baja;

class MostrarBaja extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $bajaToDelete; // ID a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarbaja');
    }

    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->bajaToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteBaja()
    {
        if ($this->bajaToDelete) {
            Baja::find($this->bajaToDelete)->delete();
            session()->flash('message', 'Baja eliminada exitosamente.');
        }

        $this->bajaToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarbaja');
    }

    public function render()
    {
        return view('livewire.portal-rh.bajas.mostrar-baja')->layout('layouts.client');
    }
}
