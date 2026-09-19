<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasSucursal;

use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarPreguntaSucursal extends Component
{
    public $pregunta = [
        'texto' => '',
        'descripcion' => '',
        'empresa_id' => '',
        'sucursal_id' => ''
    ];

    public $respuestas = [];

    public function mount()
    {
        $this->pregunta['empresa_id'] = Auth::user()->empresa_id;
        $this->pregunta['sucursal_id'] = Auth::user()->sucursal_id;

        $this->respuestas = [
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => '']
        ];
    }

    protected $rules = [
        'pregunta.texto' => 'required|min:10',
        'pregunta.descripcion' => 'required|max:500',
        'pregunta.empresa_id' => 'required|exists:empresas,id',
        'pregunta.sucursal_id' => 'required|exists:sucursales,id',
        'respuestas.*.texto' => 'required|min:5',
        'respuestas.*.puntuacion' => 'required|integer|min:0|max:4', // Updated to 0-4
    ];

    protected $messages = [
        'pregunta.texto.required' => 'El texto de la pregunta es obligatorio.',
        'pregunta.texto.min' => 'El texto debe tener al menos 10 caracteres.',
        'pregunta.descripcion.required' => 'La descripción es obligatoria.',
        'pregunta.descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
        'pregunta.empresa_id.required' => 'La empresa es obligatoria.',
        'pregunta.empresa_id.exists' => 'La empresa seleccionada no es válida.',
        'pregunta.sucursal_id.required' => 'La sucursal es obligatoria.',
        'pregunta.sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
        'respuestas.*.texto.required' => 'El texto de la respuesta es obligatorio.',
        'respuestas.*.texto.min' => 'El texto de la respuesta debe tener al menos 5 caracteres.',
        'respuestas.*.puntuacion.required' => 'La puntuación es obligatoria.',
        'respuestas.*.puntuacion.integer' => 'La puntuación debe ser un número entero.',
        'respuestas.*.puntuacion.min' => 'La puntuación debe ser al menos 0.', // Updated message
        'respuestas.*.puntuacion.max' => 'La puntuación no debe ser mayor a 4.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function savePreguntaSucursal()
    {
        $this->validate();

        try {
            // Crear la pregunta con empresa_id y sucursal_id
            $nuevaPregunta = Pregunta::create([
                'texto' => $this->pregunta['texto'],
                'descripcion' => $this->pregunta['descripcion'],
                'empresa_id' => $this->pregunta['empresa_id'],
                'sucursal_id' => $this->pregunta['sucursal_id'],
            ]);

            // Crear las respuestas asociadas a la pregunta, incluyendo empresa_id y sucursal_id
            foreach ($this->respuestas as $respuesta) {
                $nuevaPregunta->respuestas()->create([
                    'texto' => $respuesta['texto'],
                    'puntuacion' => $respuesta['puntuacion'],
                    'empresa_id' => $this->pregunta['empresa_id'],
                    'sucursal_id' => $this->pregunta['sucursal_id'],
                ]);
            }

            // Limpiar los campos después de guardar
            $this->reset(['pregunta', 'respuestas']);
            $this->mount(); // Reinicializar las respuestas

            $this->dispatch('toastr-success', message: 'Pregunta y respuestas guardadas correctamente.');
            return redirect()->route('portal360.preguntas.preguntas-sucursal.mostrar-pregunta-sucursal');
        } catch (\Exception $e) {
            logger($e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al guardar la pregunta: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-sucursal.agregar-pregunta-sucursal')->layout('layouts.portal360');
    }
}
