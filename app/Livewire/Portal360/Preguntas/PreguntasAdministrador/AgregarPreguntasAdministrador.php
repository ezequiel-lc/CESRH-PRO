<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasAdministrador;

use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use Livewire\Component;

class AgregarPreguntasAdministrador extends Component
{
    public $pregunta = [
        'texto' => '',
        'descripcion' => ''
    ];

    public $respuestas = [];
    public $empresas = [];
    public $empresa_id;
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

        $this->empresas = Empresa::select('id', 'nombre')->get();
    }

    protected $rules = [
        'pregunta.texto' => 'required|min:10',
        'pregunta.descripcion' => 'required|max:500',
        'respuestas.*.texto' => 'required|min:5',
        'respuestas.*.puntuacion' => 'required|integer|min:0|max:4', // Cambiado min:1 a min:0
        'empresa_id' => 'required|exists:empresas,id',
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
        'respuestas.*.puntuacion.min' => 'La puntuación debe ser al menos 0.', // Cambiado de 1 a 0
        'respuestas.*.puntuacion.max' => 'La puntuación no debe ser mayor a 4.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'empresa_id.exists' => 'La empresa seleccionada no es válida.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
    ];

    public function updatedEmpresaId($value)
    {
        if (!empty($value)) {
            try {
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                $this->sucursales = $empresa->sucursales;
                $this->sucursal_id = '';
                
                $this->dispatch('toastr-success', message: 'Sucursales cargadas correctamente.');
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar las sucursales: ' . $e->getMessage());
                $this->sucursales = collect();
            }
        } else {
            $this->sucursales = collect();
            $this->sucursal_id = '';
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function savePreguntaAdministrador()
    {
        $this->validate();

        try {
            $nuevaPregunta = Pregunta::create([
                'texto' => $this->pregunta['texto'],
                'descripcion' => $this->pregunta['descripcion']
            ]);

            foreach ($this->respuestas as $respuesta) {
                $nuevaPregunta->respuestas()->create([
                    'texto' => $respuesta['texto'],
                    'puntuacion' => $respuesta['puntuacion'],
                    'empresa_id' => $this->empresa_id,
                    'sucursal_id' => $this->sucursal_id
                ]);
            }

            $this->reset(['pregunta', 'respuestas', 'empresa_id', 'sucursal_id']);
            $this->mount();

            $this->dispatch('toastr-success', message: 'Pregunta y respuestas guardadas correctamente.');
            return redirect()->route('portal360.preguntas.preguntas-administrador.mostrar-preguntas-administrador');

        } catch (\Exception $e) {
            logger($e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al guardar la pregunta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-administrador.agregar-preguntas-administrador')->layout('layouts.portal360');
    }
}
