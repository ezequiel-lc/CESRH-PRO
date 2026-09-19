<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use Illuminate\Support\Facades\Auth;

class AgregarFunEspecificasSucursal extends Component
{
    public $empresa_id;
    public $sucursal_id; 
    public $funcion = [];

    protected $rules = [
        'funcion.nombre' => 'required',
    ];

    protected $messages = [
        'funcion.nombre.required' => 'La función específica es obligatoria.',
    ];

    public function mount()
    {
        // Obtener la empresa y sucursal desde el usuario autenticado
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
    }

    public function agregarFuncion()
    {
        $this->validate();

        FuncionEspecifica::create([
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
            'nombre' => $this->funcion['nombre']
        ]);

        // Resetear solo la función específica
        $this->funcion = [];

        session()->flash('message', 'Función específica agregada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-sucursal.agregar-fun-especificas-sucursal')
            ->layout("layouts.portal_capacitacion");
    }
}
