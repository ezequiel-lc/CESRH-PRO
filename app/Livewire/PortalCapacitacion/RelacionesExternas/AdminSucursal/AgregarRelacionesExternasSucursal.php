<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Auth;

class AgregarRelacionesExternasSucursal extends Component
{
    public $externa=[];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'externa.nombre' => 'required',
        'externa.razon_motivo' => 'required',
        'externa.frecuencia' => 'required',
    ];

    protected $messages = [
        'externa.nombre.required' => 'El nombre es obligatorio.',
        'externa.razon_motivo.required' => 'La razón o motivo es obligatorio.',
        'externa.frecuencia.required' => 'El frecuencia es obligatorio.',
    ];

    public function mount()
    {
        // Obtener la empresa y sucursal desde el usuario autenticado
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
    }

    public function agregarExterna()
    {
        $this->validate();

        RelacionExterna::create([
            'nombre' => $this->externa['nombre'],
            'razon_motivo' => $this->externa['razon_motivo'],
            'frecuencia' => $this->externa['frecuencia'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->externa = [];

        session()->flash('message', 'Relacion externa creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-sucursal.agregar-relaciones-externas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
