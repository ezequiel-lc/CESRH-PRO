<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class MostrarRelacionesExternas extends Component
{
    public $showModal = false;
    public $funcionToDelete;

    public function redirigir(){
        return redirect()->route('agregarRelacionesExternas');
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

        return redirect()->route('mostrarRelacionesExternas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-general.mostrar-relaciones-externas')->layout("layouts.portal_capacitacion");
    }
}