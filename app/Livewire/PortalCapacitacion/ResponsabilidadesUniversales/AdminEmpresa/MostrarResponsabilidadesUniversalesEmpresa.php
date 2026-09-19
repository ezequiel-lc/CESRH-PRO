<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Illuminate\Support\Facades\Response;

class MostrarResponsabilidadesUniversalesEmpresa extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarResponsabilidadesUniversalesEmpresa');
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
            ResponsabilidadUniversal::find($this->funcionToDelete)->delete();
            session()->flash('message', 'Responsabilidad Universal eliminada exitosamente.');
        }

        $this->funcionToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarResponsabilidadesUniversalesEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-empresa.mostrar-responsabilidades-universales-empresa')->layout("layouts.portal_capacitacion");
    }
}