<?php

namespace App\Livewire\Dx035\Cuestionarios;

use Livewire\Component;
use App\Models\Dx035\PreguntaBase;
use App\Models\Dx035\Cuestionario;

class AgregarPreguntaBase extends Component
{
    public $pregunta, $seccion, $categoria, $dominio, $dimension, $puntuacion, $cuestionarios_id;
    public $cuestionarios; // Lista de cuestionarios disponibles

    protected $rules = [
        'pregunta' => 'required|string|max:255',
        'seccion' => 'nullable|string|max:255',
        'categoria' => 'nullable|string|max:255',
        'dominio' => 'nullable|string|max:255',
        'dimension' => 'nullable|string|max:255',
        'puntuacion' => 'nullable|numeric|min:0',
        'cuestionarios_id' => 'required|exists:cuestionarios,id',
    ];

    public function mount()
    {
        // Cargar los cuestionarios disponibles
        $this->cuestionarios = Cuestionario::all();
    }

    public function submit()
    {
        $this->validate();

        PreguntaBase::create([
            'Pregunta' => $this->pregunta, // Cambiado a mayúsculas
            'Seccion' => $this->seccion,   // Cambiado a mayúsculas
            'Categoria' => $this->categoria, // Cambiado a mayúsculas
            'Dominio' => $this->dominio,   // Cambiado a mayúsculas
            'Dimension' => $this->dimension, // Cambiado a mayúsculas
            'Puntuacion' => $this->puntuacion, // Cambiado a mayúsculas
            'cuestionarios_id' => $this->cuestionarios_id,
        ]);

        session()->flash('message', 'Pregunta agregada correctamente.');
        $this->reset(['pregunta', 'seccion', 'categoria', 'dominio', 'dimension', 'puntuacion', 'cuestionarios_id']);
    }

    public function render()
    {
        return view('livewire.dx035.cuestionarios.agregar-pregunta-base')
            ->layout('layouts.dx035');
    }
}
