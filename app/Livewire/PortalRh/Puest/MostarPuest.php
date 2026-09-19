<?php

namespace App\Livewire\PortalRh\Puest;

use Livewire\Component;
use App\Models\PortalRH\Puesto;

class MostarPuest extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $puestoToDelete; // ID a eliminar

    public function redirigir()
    {
        return redirect()->route('agregarpuesto');
    }

    //Eliminar
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->puestoToDelete = $id;
        $this->showModal = true;
    }
    
    public function deletePuesto()
    {
        if ($this->puestoToDelete) {
            Puesto::find($this->puestoToDelete)->delete();
            session()->flash('message', 'Departamento eliminado exitosamente.');
        }

        $this->puestoToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarpuesto');
    }

    public function render()
    {
        return view('livewire.portal-rh.puest.mostar-puest')->layout('layouts.client');
    }
}
