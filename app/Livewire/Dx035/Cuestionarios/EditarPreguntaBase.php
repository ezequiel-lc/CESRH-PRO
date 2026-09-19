<?php

namespace App\Livewire\Dx035\Cuestionarios;

use Livewire\Component;
use App\Models\Dx035\PreguntaBase;
use App\Models\Dx035\Cuestionario;

class EditarPreguntaBase extends Component
{
    public $preguntaBase;
    public $pregunta, $seccion, $categoria, $dominio, $dimension, $puntuacion, $cuestionarios_id;
    public $cuestionarios; // Lista de cuestionarios disponibles

    public function mount($id)
    {
        // Obtener la pregunta base por ID
        $this->preguntaBase = PreguntaBase::findOrFail($id);

        // Asignar los valores actuales a las propiedades
        $this->pregunta = $this->preguntaBase->pregunta;
        $this->seccion = $this->preguntaBase->seccion;
        $this->categoria = $this->preguntaBase->categoria;
        $this->dominio = $this->preguntaBase->dominio;
        $this->dimension = $this->preguntaBase->dimension;
        $this->puntuacion = $this->preguntaBase->puntuacion;
        $this->cuestionarios_id = $this->preguntaBase->cuestionarios_id;

        // Cargar los cuestionarios disponibles
        $this->cuestionarios = Cuestionario::all();
    }

    public function submit()
    {
        $this->validate([
            'pregunta' => 'required|string|max:255',
            'seccion' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'dominio' => 'nullable|string|max:255',
            'dimension' => 'nullable|string|max:255',
            'puntuacion' => 'nullable|numeric|min:0',
            'cuestionarios_id' => 'required|exists:cuestionarios,id',
        ]);

        // Actualizar la pregunta base
        $this->preguntaBase->update([
            'pregunta' => $this->pregunta,
            'seccion' => $this->seccion,
            'categoria' => $this->categoria,
            'dominio' => $this->dominio,
            'dimension' => $this->dimension,
            'puntuacion' => $this->puntuacion,
            'cuestionarios_id' => $this->cuestionarios_id,
        ]);

        session()->flash('message', 'Pregunta actualizada correctamente.');
        return redirect()->route('preguntas.mostrar');
    }

    public function render()
    {
        return view('livewire.dx035.cuestionarios.editar-pregunta-base')
            ->layout('layouts.dx035');
    }
}
