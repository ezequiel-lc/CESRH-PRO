<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasEmpresa;

use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarPreguntasEmpresa extends Component
{
    public $pregunta = [
        'texto' => '',
        'descripcion' => ''
    ];

    public $respuestas = [];
    public $sucursales = [];
    public $sucursal_id;

    public function mount()
    {
        $this->respuestas = [
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => ''],
            ['texto' => '', 'puntuacion' => '']
        ];

        // Obtener el empresa_id del usuario autenticado y cargar sucursales
        $empresa = Empresa::find(Auth::user()->empresa_id);
        $this->sucursales = $empresa->sucursales()
            ->select('sucursales.id', 'sucursales.nombre_sucursal')
            ->get();
    }

    protected $rules = [
        'pregunta.texto' => 'required|min:10',
        'pregunta.descripcion' => 'required|max:500',
        'respuestas.*.texto' => 'required|min:5',
        'respuestas.*.puntuacion' => 'required|integer|min:0|max:4', // Updated to 0-4
        'sucursal_id' => 'required|exists:sucursales,id',
    ];

    protected $messages = [
        'pregunta.texto.required' => 'El texto de la pregunta es obligatorio.',
        'pregunta.texto.min' => 'El texto debe tener al menos 10 caracteres.',
        'pregunta.descripcion.required' => 'La descripción es obligatoria.',
        'pregunta.descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
        'respuestas.*.texto.required' => 'El texto de la respuesta es obligatorio.',
        'respuestas.*.texto.min' => 'El texto de la respuesta debe tener al menos 5 caracteres.',
        'respuestas.*.puntuacion.required' => 'La puntuación es obligatoria.',
        'respuestas.*.puntuacion.integer' => 'La puntuación debe ser un número entero.',
        'respuestas.*.puntuacion.min' => 'La puntuación debe ser al menos 0.', // Updated message
        'respuestas.*.puntuacion.max' => 'La puntuación no debe ser mayor a 4.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function savePreguntaSucursal()
    {
        $this->validate();

        try {
            // Crear la pregunta
            $nuevaPregunta = Pregunta::create([
                'texto' => $this->pregunta['texto'],
                'descripcion' => $this->pregunta['descripcion']
            ]);

            // Crear las respuestas asociadas a la pregunta usando el empresa_id del usuario autenticado
            foreach ($this->respuestas as $respuesta) {
                $nuevaPregunta->respuestas()->create([
                    'texto' => $respuesta['texto'],
                    'puntuacion' => $respuesta['puntuacion'],
                    'sucursal_id' => $this->sucursal_id,
                    'empresa_id' => Auth::user()->empresa_id
                ]);
            }

            // Limpiar los campos después de guardar
            $this->reset(['pregunta', 'respuestas', 'sucursal_id']);
            $this->mount(); // Reinicializar las respuestas y sucursales

            $this->dispatch('toastr-success', message: 'Pregunta y respuestas guardadas correctamente.');
            return redirect()->route('portal360.preguntas.preguntas-empresa.mostrar-preguntas-empresa');

        } catch (\Exception $e) {
            logger($e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al guardar la pregunta: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-empresa.agregar-preguntas-empresa')->layout('layouts.portal360');
    }
}
