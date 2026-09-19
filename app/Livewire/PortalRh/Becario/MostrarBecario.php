<?php

namespace App\Livewire\PortalRh\Becario;

use Livewire\Component;
use App\Models\PortalRH\Becario;

class MostrarBecario extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $becarioToDelete; // ID de la sucursal a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarbecario');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->becarioToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteBecario()
    {
        if ($this->becarioToDelete) {
            Becario::find($this->becarioToDelete)->delete();
            session()->flash('message', 'Becario eliminado exitosamente.');
        }

        $this->becarioToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarbecario');
    }


    public function render()
    {
        return view('livewire.portal-rh.becario.mostrar-becario')->layout('layouts.client');
    }
}
