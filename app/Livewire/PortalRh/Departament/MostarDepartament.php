<?php

namespace App\Livewire\PortalRh\Departament;

use Livewire\Component;
use App\Models\PortalRH\Departamento;

class MostarDepartament extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $depaToDelete; // ID a eliminar

    public function redirigir()
    {
        return redirect()->route('agregardepa');
    }

    //Eliminar
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->depaToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteDepa()
    {
        if ($this->depaToDelete) {
            Departamento::find($this->depaToDelete)->delete();
            session()->flash('message', 'Departamento eliminado exitosamente.');
        }

        $this->depaToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrardepa');
    }

    public function render()
    {
        return view('livewire.portal-rh.departament.mostar-departament')->layout('layouts.client');
    }
}
