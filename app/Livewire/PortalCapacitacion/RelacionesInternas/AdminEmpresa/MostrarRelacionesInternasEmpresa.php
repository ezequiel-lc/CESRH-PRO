<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesInternasEmpresa extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesInternasEmpresa');
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
            RelacionInterna::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Relacion Interna eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarRelacionesInternasEmpresa');
    }
    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-empresa.mostrar-relaciones-internas-empresa')->layout("layouts.portal_capacitacion");
    }
}
