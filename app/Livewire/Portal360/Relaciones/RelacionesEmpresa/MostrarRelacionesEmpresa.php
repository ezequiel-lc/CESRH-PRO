<?php

namespace App\Livewire\Portal360\Relaciones\RelacionesEmpresa;

use App\Models\Encuestas360\Relacion;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarRelacionesEmpresa extends Component
{
    //use WithPagination;
    use WithPagination;

    public $porpagina = 5;
    public $search;

    // Método para redireccionar a la vista de agregar Usuario 
    public function redirigirRelacionesEmpresa()
    {
        return redirect()->route('agregarRealacionEmpresa');
    }

    // Inicialización del componente
    public function mountRelacionesEmpresa()
    {
        $this->search = "";
    }

    public function updatedSearchRelacionesEmpresa()
    {
        $this->resetPage();
    }

    public function updatedPorpaginaRelacionesEmpresa()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.portal360.relaciones.relaciones-empresa.mostrar-relaciones-empresa', [
            'relacionesuser' => Relacion::where('nombre', 'LIKE', "%{$this->search}%")
                ->orderBy('nombre', 'ASC')
                ->paginate($this->porpagina),
        ])->layout('layouts.portal360');
    }

    public function deleteRelacionesEmpresa($id)
    {
        //Relacion::find($id)?->delete(); 
        $this->dispatch('eliminarRelacionesEmpresas', id: $id);
    }

    #[On('delete')]
    public function delete($id){
        info("here");
        Relacion::find($id)->delete();
    }


    // public function render()
    // {
    //     return view('livewire.portal360.relaciones.relaciones-empresa.mostrar-relaciones-empresa');
    // }
}
