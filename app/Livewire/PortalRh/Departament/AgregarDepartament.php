<?php

namespace App\Livewire\PortalRh\Departament;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;

class AgregarDepartament extends Component
{
    public $departamento = []; // Almacena los datos del formulario
    public $sucursales, $sucursal_id;

    public function mount()
    {
        $this->sucursales = Sucursal::all();
    }
    
    // Reglas de validación
    protected $rules = [
        'departamento.nombre_departamento' => 'required',
        'sucursal_id' => 'required|exists:sucursales,id',
    ];

    protected $messages = [
        'departamento.nombre_departamento.required' => 'El nombre del departamento es obligatorio.',
        'sucursal_id.required' => 'Debe seleccionar una Sucursal.',
        'sucursal_id.exists' => 'La Sucursal seleccionada no es válida.',
    ];

    public function saveDepartament()
    {
        $this->validate();

        $nuevoDepartamento = Departamento::create($this->departamento);
        $nuevoDepartamento->sucursales()->attach($this->sucursal_id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Limpiar los datos del formulario
        $this->reset(['departamento', 'sucursal_id']);
        
        //$this->emit('showAnimatedToast', 'Departamento guardado correctamente.');
        return redirect()->route('mostrardepa');
    }

    public function redirigir()
    {
        return redirect()->route('mostrardepa');
    }

    public function render()
    {
        return view('livewire.portal-rh.departament.agregar-departament')->layout('layouts.client');
    }
}
