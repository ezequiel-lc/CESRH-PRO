<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasAdministrador;

use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarPreguntasAdministrador extends Component
{
    public $preguntaId;
    public $pregunta = [
        'texto' => '',
        'descripcion' => ''
    ];
    
    public $respuestas = [];
    public $empresas = [];
    public $empresa_id;
    public $sucursales = [];
    public $sucursal_id;

    protected $rules = [
        'pregunta.texto' => 'required|min:10',
        'pregunta.descripcion' => 'required|max:500',
        'respuestas.*.texto' => 'required|min:5',
        'respuestas.*.puntuacion' => 'required|integer|min:0|max:4', // Cambiado min:1 a min:0
        'empresa_id' => 'required|exists:empresas,id',
        'sucursal_id' => 'required|exists:sucursales,id'
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

    public function mount($id)
    {
        try {
            $this->preguntaId = Crypt::decrypt($id);

            $pregunta = Pregunta::with('respuestas')->findOrFail($this->preguntaId);

            $this->pregunta = [
                'texto' => $pregunta->texto,
                'descripcion' => $pregunta->descripcion
            ];

            $this->respuestas = $pregunta->respuestas->map(function ($respuesta) {
                return [
                    'id' => $respuesta->id,
                    'texto' => $respuesta->texto,
                    'puntuacion' => $respuesta->puntuacion,
                    'empresa_id' => $respuesta->empresa_id,
                    'sucursal_id' => $respuesta->sucursal_id
                ];
            })->toArray();

            while (count($this->respuestas) < 4) {
                $this->respuestas[] = [
                    'id' => null,
                    'texto' => '',
                    'puntuacion' => '',
                    'empresa_id' => null,
                    'sucursal_id' => null
                ];
            }

            $this->empresas = Empresa::select('id', 'nombre')->get();

            if (!empty($this->respuestas[0]['empresa_id'])) {
                $this->empresa_id = $this->respuestas[0]['empresa_id'];
                
                // Cargar las sucursales de la empresa seleccionada
                $empresa = Empresa::with('sucursales')->find($this->empresa_id);
                $this->sucursales = $empresa->sucursales;
                
                // Establecer la sucursal seleccionada
                if (!empty($this->respuestas[0]['sucursal_id'])) {
                    $this->sucursal_id = $this->respuestas[0]['sucursal_id'];
                }
            }
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al cargar la pregunta: ' . $e->getMessage());
        }
    }

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

    public function editarPreguntaAdmin()
    {
        $this->validate();

        try {
            $pregunta = Pregunta::findOrFail($this->preguntaId);
            $pregunta->update([
                'texto' => $this->pregunta['texto'],
                'descripcion' => $this->pregunta['descripcion']
            ]);

            foreach ($this->respuestas as $respuestaData) {
                if (isset($respuestaData['id']) && !empty($respuestaData['id'])) {
                    $pregunta->respuestas()->updateOrCreate(
                        ['id' => $respuestaData['id']],
                        [
                            'texto' => $respuestaData['texto'],
                            'puntuacion' => $respuestaData['puntuacion'],
                            'empresa_id' => $this->empresa_id,
                            'sucursal_id' => $this->sucursal_id
                        ]
                    );
                } else if (!empty($respuestaData['texto']) || !empty($respuestaData['puntuacion'])) {
                    $pregunta->respuestas()->create([
                        'texto' => $respuestaData['texto'],
                        'puntuacion' => $respuestaData['puntuacion'],
                        'empresa_id' => $this->empresa_id,
                        'sucursal_id' => $this->sucursal_id
                    ]);
                }
            }

            $this->dispatch('toastr-success', message: 'Pregunta editada correctamente.');
            return redirect()->route('portal360.preguntas.preguntas-administrador.mostrar-preguntas-administrador');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al editar la pregunta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-administrador.editar-preguntas-administrador')->layout('layouts.portal360');
    }
}
