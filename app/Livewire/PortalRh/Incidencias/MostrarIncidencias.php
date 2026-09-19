<?php

namespace App\Livewire\PortalRh\Incidencias;

use Livewire\Component;
use App\Models\PortalRH\Incidencia;

class MostrarIncidencias extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $incidenciaToDelete; // ID a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarincidencia');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->incidenciaToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteIncidencia()
    {
        if ($this->incidenciaToDelete) {
            Incidencia::find($this->incidenciaToDelete)->delete();
            session()->flash('message', 'Incidencia eliminada exitosamente.');
        }

        $this->incidenciaToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarincidencia');
    }

    public function render()
    {
        return view('livewire.portal-rh.incidencias.mostrar-incidencias')->layout('layouts.client');
    }
}
