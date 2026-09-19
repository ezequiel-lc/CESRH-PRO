<?php

namespace App\Livewire\PortalRh\Empres;

use App\Models\PortalRH\Empresa;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;


class MostrarEmpres extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $empresToDelete; // ID a eliminar

    public function redirigir()
    {
        return redirect()->route('agregarempresa');
    }

    //Eliminar
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->empresToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteSucursal()
    {
        if ($this->empresToDelete) {
            Empresa::find($this->empresToDelete)->delete();
            session()->flash('message', 'Empresa eliminada exitosamente.');
        }

        $this->empresToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarempresas');
    }

    public function render()
    {
        return view('livewire.portal-rh.empres.mostrar-empres')->layout('layouts.client');

    }
}
