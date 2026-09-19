<?php

namespace App\Livewire\Portal360\Relaciones\RelacionesSucursal;

use App\Models\Encuestas360\Relacion;
use Livewire\Component;

class AgregarRelacionesSucursales extends Component
{
    public $relaciones = [];

    protected $rules = [
        'relaciones.nombre' => 'required|min:3',
    ];

    protected $messages = [
        'relaciones.nombre.min' => 'El nombre debe tener al menos 3 caracteres',
    ];

    public function saveRelacionesSucursales(){
        $this->validate();
    
        try {
            $nuevoRelaciones = new Relacion($this->relaciones);
            $nuevoRelaciones->save();
    
            $this->relaciones = [];
    
            // Notificación de éxito
            $this->dispatch('toastr-success', message: 'Relación Guardada Correctamente.');
    
            return redirect()->route('portal360.relaciones.relaciones-sucursal.mostrar-relaciones-sucursales');
        } catch (\Exception $e) {
            // Notificación de error
            $this->dispatch('toastr-error', message: 'Error al guardar la relación: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.relaciones.relaciones-sucursal.agregar-relaciones-sucursales')->layout('layouts.portal360');
    }

    // public function render()
    // {
    //     return view('livewire.portal360.relaciones.relaciones-sucursal.agregar-relaciones-sucursales');
    // }
}
