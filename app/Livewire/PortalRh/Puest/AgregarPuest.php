<?php

namespace App\Livewire\PortalRh\Puest;

use Livewire\Component;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;

class AgregarPuest extends Component
{
    public $puest = [];
    public $departamentos, $departamento_id;

    public function mount()
    {
        $this->departamentos = Departamento::all();
    }

    // REGLAS DE VALIDACIÓN
    protected $rules = [
        'puest.nombre_puesto' => 'required',
        'departamento_id' => 'required|exists:departamentos,id',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'puest.nombre_puesto.required' => 'El nombre del puesto es requerido',
        'departamento_id.required' => 'Debe seleccionar un departamento.',
        'departamento_id.exists' => 'El departamento seleccionado no es válida.',
    ];

    // Método para guardar sucursal
    public function savePuesto()
    {
        $this->validate();

        $nuevoPuesto = Puesto::create($this->puest);
        $nuevoPuesto->departamentos()->attach($this->departamento_id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->reset(['puest', 'departamento_id']);
        //$this->emit('showAnimatedToast', 'Sucursal guardada correctamente');
        return redirect()->route('mostrarpuesto');
    }

    public function redirigirPuest()
    {
        return redirect()->route('mostrarpuesto');
    }

    public function render()
    {
        return view('livewire.portal-rh.puest.agregar-puest')->layout('layouts.client');
    }
}
