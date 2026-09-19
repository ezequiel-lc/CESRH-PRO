<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasEmpresa;

use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarPreguntasEmpresa extends Component
{
    public $preguntaId;
    public $pregunta = [
        'texto' => '',
        'descripcion' => ''
    ];

    public $respuestas = [];
    public $sucursales = [];
    public $sucursal_id;

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

    public function mount($id)
    {
        try {
            $this->preguntaId = Crypt::decrypt($id);

            // Cargar la pregunta con sus respuestas
            $pregunta = Pregunta::with('respuestas')->findOrFail($this->preguntaId);

            $this->pregunta = [
                'texto' => $pregunta->texto,
                'descripcion' => $pregunta->descripcion
            ];

            // Cargar las respuestas
            $this->respuestas = $pregunta->respuestas->map(function ($respuesta) {
                return [
                    'id' => $respuesta->id,
                    'texto' => $respuesta->texto,
                    'puntuacion' => $respuesta->puntuacion,
                    'sucursal_id' => $respuesta->sucursal_id
                ];
            })->toArray();

            // Asegurar que siempre haya 4 respuestas
            while (count($this->respuestas) < 4) {
                $this->respuestas[] = [
                    'id' => null,
                    'texto' => '',
                    'puntuacion' => '',
                    'sucursal_id' => null
                ];
            }

            // Cargar sucursales a través de la relación con Empresa usando Auth
            $empresa = Empresa::find(Auth::user()->empresa_id);
            $this->sucursales = $empresa->sucursales()
                ->select('sucursales.id', 'sucursales.nombre_sucursal')
                ->get();

            // Establecer la sucursal seleccionada (si hay respuestas)
            if (!empty($this->respuestas[0]['sucursal_id'])) {
                $this->sucursal_id = $this->respuestas[0]['sucursal_id'];
            }
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al cargar la pregunta: ' . $e->getMessage());
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editarPreguntaEmpre()
    {
        $this->validate();

        try {
            // Buscar y actualizar la pregunta
            $pregunta = Pregunta::findOrFail($this->preguntaId);
            $pregunta->update([
                'texto' => $this->pregunta['texto'],
                'descripcion' => $this->pregunta['descripcion']
            ]);

            // Actualizar o crear respuestas
            foreach ($this->respuestas as $respuestaData) {
                if (isset($respuestaData['id'])) {
                    // Actualizar respuesta existente
                    $pregunta->respuestas()->updateOrCreate(
                        ['id' => $respuestaData['id']],
                        [
                            'texto' => $respuestaData['texto'],
                            'puntuacion' => $respuestaData['puntuacion'],
                            'sucursal_id' => $this->sucursal_id,
                            'empresa_id' => Auth::user()->empresa_id // Usar Auth para empresa_id
                        ]
                    );
                } else {
                    // Crear nueva respuesta
                    $pregunta->respuestas()->create([
                        'texto' => $respuestaData['texto'],
                        'puntuacion' => $respuestaData['puntuacion'],
                        'sucursal_id' => $this->sucursal_id,
                        'empresa_id' => Auth::user()->empresa_id // Usar Auth para empresa_id
                    ]);
                }
            }

            $this->dispatch('toastr-success', message: 'Pregunta editada correctamente.');
            return redirect()->route('portal360.preguntas.preguntas-empresa.mostrar-preguntas-empresa');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al editar la pregunta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-empresa.editar-preguntas-empresa')->layout('layouts.portal360');
    }
}
