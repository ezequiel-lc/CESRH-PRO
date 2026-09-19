<?php

namespace App\Livewire\Portal360\Relaciones\RelacionesSucursal;

use App\Models\Encuestas360\Relacion;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarRelacionesSucursales extends Component
{

     //use WithPagination;
     use WithPagination;

     public $porpagina = 5;
     public $search;
 
     // Método para redireccionar a la vista de agregar Usuario 
     public function redirigirRelacionesSucursales()
     {
         return redirect()->route('agregarRealacionSucursales');
     }
 
     // Inicialización del componente
     public function mountRelacionesSucursales()
     {
         $this->search = "";
     }
 
     public function updatedSearchRelacionesSucursales()
     {
         $this->resetPage();
     }
 
     public function updatedPorpaginaRelacionesSucursales()
     {
         $this->resetPage();
     }
 
     public function render()
     {
         return view('livewire.portal360.relaciones.relaciones-sucursal.mostrar-relaciones-sucursales', [
             'relacionesuser' => Relacion::where('nombre', 'LIKE', "%{$this->search}%")
                 ->orderBy('nombre', 'ASC')
                 ->paginate($this->porpagina),
         ])->layout('layouts.portal360');
     }
 
     public function deleteRelacionesSucursales($id)
     {
         //Relacion::find($id)?->delete(); 
         $this->dispatch('eliminarRelacionesSucursales', id: $id);
     }
 
     #[On('delete')]
     public function delete($id){
         info("here");
         Relacion::find($id)->delete();
     }
     

     
    // public function render()
    // {
    //     return view('livewire.portal360.relaciones.relaciones-sucursal.mostrar-relaciones-sucursales');
    // }
}
