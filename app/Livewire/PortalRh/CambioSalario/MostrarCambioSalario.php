<?php

namespace App\Livewire\PortalRh\CambioSalario;

use Livewire\Component;
use App\Models\PortalRH\CambioSalario;

class MostrarCambioSalario extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $salarioToDelete; // ID a eliminar

    // Redirigir a una vista para agregar
    public function redirigir()
    {
        return redirect()->route('agregarcambiosal');
    }

    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->salarioToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteIncidencia()
    {
        if ($this->salarioToDelete) {
            CambioSalario::find($this->salarioToDelete)->delete();
            session()->flash('message', 'Cambio de Salario eliminado exitosamente.');
        }

        $this->salarioToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarcambiosal');
    }

    public function render()
    {
        return view('livewire.portal-rh.cambio-salario.mostrar-cambio-salario')->layout('layouts.client');
    }
}
