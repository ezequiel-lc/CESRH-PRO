<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use Illuminate\Support\Facades\Response;

class MostrarHabilidadesHumanas extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarHabilidadesHumanas');
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
            FormacionHabilidadHumana::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Habilidad humana eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarHabilidadesHumanas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-humanas.admin-general.mostrar-habilidades-humanas')->layout("layouts.portal_capacitacion");
    }
}