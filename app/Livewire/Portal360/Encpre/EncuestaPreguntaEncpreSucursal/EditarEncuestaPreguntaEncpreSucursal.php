<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreSucursal;

use App\Models\Encuestas360\Encpre;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditarEncuestaPreguntaEncpreSucursal extends Component
{
    
    public $encpreId;
    public $formData = [
        'encuestas_id' => '',
        'preguntas_id' => [], // Changed to array for multiple selections
    ];

    public $encuestas = [];
    public $preguntas = [];

    protected $rules = [
        'formData.encuestas_id' => 'required|exists:360_encuestas,id',
        'formData.preguntas_id' => 'required|array|min:1', // Updated for array
        'formData.preguntas_id.*' => 'exists:preguntas,id', // Validation for each item
    ];

    protected $messages = [
        'formData.encuestas_id.required' => 'Debe seleccionar una encuesta.',
        'formData.encuestas_id.exists' => 'La encuesta seleccionada no es válida.',
        'formData.preguntas_id.required' => 'Debe seleccionar al menos una pregunta.',
        'formData.preguntas_id.array' => 'Las preguntas deben ser un arreglo válido.',
        'formData.preguntas_id.min' => 'Debe seleccionar al menos una pregunta.',
        'formData.preguntas_id.*.exists' => 'Una o más preguntas seleccionadas no son válidas.',
    ];

    public function mount($id)
    {
        try {
            $this->encpreId = Crypt::decrypt($id);
            $encpre = Encpre::findOrFail($this->encpreId);

            $this->formData['encuestas_id'] = $encpre->encuestas_id;
            $this->formData['preguntas_id'] = [$encpre->preguntas_id]; // Initialize as array with existing pregunta

            // Cargar encuestas disponibles para la empresa del usuario
            $this->encuestas = Encuesta360::where('empresa_id', Auth::user()->empresa_id)
                ->select('id', 'nombre')
                ->get();

            // Cargar preguntas disponibles
            $this->preguntas = Pregunta::whereHas('respuestas', function ($query) {
                $query->where('empresa_id', Auth::user()->empresa_id);
            })
            ->select('id', 'texto')
            ->get();

        } catch (\Exception $e) {
            Log::error('Error al montar el componente: ' . $e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al cargar los datos');
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-sucursal.mostrar-encuesta-pregunta-encpre-sucursal');
        }
    }

    public function updatedFormDataEncuestasId($value)
    {
        $this->formData['preguntas_id'] = [];
        $this->preguntas = collect();

        if (!empty($value)) {
            try {
                $this->preguntas = Pregunta::whereHas('respuestas', function ($query) {
                    $query->where('empresa_id', Auth::user()->empresa_id);
                })
                ->select('id', 'texto')
                ->get();
            } catch (\Exception $e) {
                Log::error('Error al cargar preguntas: ' . $e->getMessage());
                $this->dispatch('toastr-error', message: 'Error al cargar preguntas');
            }
        }
    }

    public function editarEncuestaSucursal()
    {
        $this->validate();

        try {
            $encpre = Encpre::findOrFail($this->encpreId);

            // Actualizar el registro existente con la primera pregunta seleccionada
            $encpre->update([
                'encuestas_id' => $this->formData['encuestas_id'],
                'preguntas_id' => $this->formData['preguntas_id'][0], // Primera pregunta para el registro actual
            ]);

            // Manejar preguntas adicionales si hay más de una seleccionada
            if (count($this->formData['preguntas_id']) > 1) {
                foreach (array_slice($this->formData['preguntas_id'], 1) as $preguntaId) {
                    $existe = Encpre::where('encuestas_id', $this->formData['encuestas_id'])
                        ->where('preguntas_id', $preguntaId)
                        ->exists();

                    if (!$existe) {
                        Encpre::create([
                            'encuestas_id' => $this->formData['encuestas_id'],
                            'preguntas_id' => $preguntaId,
                        ]);
                    }
                }
            }

            $this->dispatch('toastr-success', message: 'Relación actualizada correctamente.');
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-sucursal.mostrar-encuesta-pregunta-encpre-sucursal');

        } catch (\Exception $e) {
            Log::error('Error al actualizar: ' . $e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al actualizar: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-sucursal.editar-encuesta-pregunta-encpre-sucursal')->layout('layouts.portal360');
    }
}
