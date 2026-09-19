<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use Illuminate\Support\Facades\Response;

class MostrarHabilidadesTecnicasSucursal extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarHabilidadesTecnicasSucursal');
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
            FormacionHabilidadTecnica::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Habilidad tecnica eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarHabilidadesTecnicasSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-sucursal.mostrar-habilidades-tecnicas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
