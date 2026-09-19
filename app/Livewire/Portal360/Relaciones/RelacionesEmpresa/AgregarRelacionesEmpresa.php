<?php

namespace App\Livewire\Portal360\Relaciones\RelacionesEmpresa;

use App\Models\Encuestas360\Relacion;
use Livewire\Component;

class AgregarRelacionesEmpresa extends Component
{
    public $relaciones = [];

    protected $rules = [
        'relaciones.nombre' => 'required|min:3',
    ];

    protected $messages = [
        'relaciones.nombre.min' => 'El nombre debe tener al menos 3 caracteres',
    ];

    public function saveRelacionesEmpresa(){
        $this->validate();
    
        try {
            $nuevoRelaciones = new Relacion($this->relaciones);
            $nuevoRelaciones->save();
    
            $this->relaciones = [];
    
            // Notificación de éxito
            $this->dispatch('toastr-success', message: 'Relación Guardada Correctamente.');
    
            return redirect()->route('portal360.relaciones.relaciones-empresa.mostrar-relaciones-empresa');
        } catch (\Exception $e) {
            // Notificación de error
            $this->dispatch('toastr-error', message: 'Error al guardar la relación: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.relaciones.relaciones-empresa.agregar-relaciones-empresa')->layout('layouts.portal360');
    }
}
