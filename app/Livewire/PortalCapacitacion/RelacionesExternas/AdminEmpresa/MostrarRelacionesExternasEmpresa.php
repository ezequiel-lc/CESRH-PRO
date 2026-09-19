<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesExternasEmpresa extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesExternasEmpresa');
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
            RelacionExterna::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Relación externa eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarRelacionesExternasEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-empresa.mostrar-relaciones-externas-empresa')->layout("layouts.portal_capacitacion");
    }
}