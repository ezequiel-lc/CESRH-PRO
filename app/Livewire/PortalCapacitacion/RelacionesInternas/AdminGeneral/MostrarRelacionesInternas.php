<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesInternas extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesInternas');
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

        return redirect()->route('mostrarRelacionesInternas');
    }
    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-general.mostrar-relaciones-internas')->layout("layouts.portal_capacitacion");
    }
}
