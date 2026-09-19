<?php

namespace App\Livewire\PortalCapacitacion\Cursos\Tematicas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\Tematica;
use Illuminate\Support\Facades\Response;

class MostrarTematica extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarTematicas');
    }

    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->funcionToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteFuncion()
    {
        if ($this->funcionToDelete) {
            Tematica::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Tematica eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('verTematicas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.cursos.tematicas.admin-general.mostrar-tematica')->layout("layouts.portal_capacitacion");
    }
}
