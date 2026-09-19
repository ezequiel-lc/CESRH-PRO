<?php

namespace App\Livewire\Portal360;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class MostrarRolesDev extends Component
{

     //use WithPagination;
     use WithPagination;

     public $porpagina = 5;
     public $search;
 
     // Método para redireccionar a la vista de agregar Usuario 
     public function redirigirRoles()
     {
         return redirect()->route('agregarRoles');
     }
 
     // Inicialización del componente
     public function mountRoles()
     {
         $this->search = "";
     }
 
     public function updatedSearchRoles()
     {
         $this->resetPage();
     }
 
     public function updatedPorpaginaRoles()
     {
         $this->resetPage();
     }
 
     public function render()
     {
         return view('livewire.portal360.mostrar-roles-dev', [
             'rolUser' => Permission::where('name', 'LIKE', "%{$this->search}%")
                 ->orderBy('name', 'ASC')
                 ->paginate($this->porpagina),
         ])->layout('layouts.portal360');
     }

     public function deleteRoles($id)
    {
        //Relacion::find($id)?->delete(); 
        $this->dispatch('eliminarRoles', id: $id);
    }

    #[On('delete')]
    public function delete($id){
        info("here");
        Permission::find($id)->delete();
    }

    // public function render()
    // {
    //     return view('livewire.portal360.mostrar-roles-dev');
    // }
}
