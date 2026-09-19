<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Auth;

class AgregarRelacionesInternasSucursal extends Component
{
    public $interna=[];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'interna.puesto' => 'required',
        'interna.razon_motivo' => 'required',
        'interna.frecuencia' => 'required',
    ];

    protected $messages = [
        'interna.puesto.required' => 'El campo puesto es obligatorio',
        'interna.razon_motivo.required' => 'El campo razón motivo es obligatorio',
        'interna.frecuencia.required' => 'El campo frecuencia es obligatorio',  
    ];

    public function mount()
    {
        // Obtener la empresa y sucursal desde el usuario autenticado
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
    }

    public function agregarInterna()
    {
        $this->validate();

        RelacionInterna::create([
            'puesto' => $this->interna['puesto'],
            'razon_motivo' => $this->interna['razon_motivo'],
            'frecuencia' => $this->interna['frecuencia'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,  // Se agrega la sucursal al relacion interna en la creación
        ]);
        $this->interna=[];
        
        session()->flash('message', 'Relación externa creada exitosamente.');
        
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-sucursal.agregar-relaciones-internas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
