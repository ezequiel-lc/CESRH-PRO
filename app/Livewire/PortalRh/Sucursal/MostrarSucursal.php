<?php

namespace App\Livewire\PortalRh\Sucursal;

use App\Models\PortalRH\Sucursal;
use Livewire\Component;

class MostrarSucursal extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $sucursalToDelete; // ID de la sucursal a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarsucursal');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->sucursalToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteSucursal()
    {
        if ($this->sucursalToDelete) {
            Sucursal::find($this->sucursalToDelete)->delete();
            session()->flash('message', 'Sucursal eliminada exitosamente.');
        }

        $this->sucursalToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarsucursal');
    }

    public function render()
    {
        return view('livewire.portal-rh.sucursal.mostrar-sucursal')->layout('layouts.client');
    }
}
