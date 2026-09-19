<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\ActivoFijo\Tipoactivo;

class Agregartipoactivo extends ModalComponent
{
    public $nombretipo;
    public $consulta;

    public function mount()
    {
        $this->consulta = Tipoactivo::all(); // Obtener todos los tipos de activo
    }

    // Reglas de validación para el campo 'nombretipo'
    protected $rules = [
        'nombretipo' => 'required|string|max:255',
    ];

    protected $validationAttributes = [
        'nombretipo' => 'Name'
    ];

    public function agregarTipoActivo()
    {
        $this->validate();
        $tipo = Tipoactivo::create([
            'nombre_activo' => $this->nombretipo
        ]);

        // Cerrar el modal
        $this->closeModal();

        // Redirigir a la ruta deseada
        return redirect()->route('mostrartipoactivo');
    }
    public function render()
    {
        return view('livewire.agregartipoactivo');
    }
}
