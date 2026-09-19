<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador;

use App\Models\Encuestas360\Encpre;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use Livewire\Component;
use Illuminate\Support\Facades\Log; // Importa la clase Log

class AgregarEncuestaPreguntaEncpreAdministrador extends Component
{

    public $formData = [
        'encuestas_id' => '',
        'preguntas_id' => [],
        'empresa_id' => '',
        'sucursal_id' => ''
    ];

    public $encuestas = [];
    public $preguntas = [];
    public $empresas = [];
    public $sucursales = [];

    protected $rules = [
        'formData.encuestas_id' => 'required|exists:360_encuestas,id',
        'formData.preguntas_id' => 'required|array|min:1',
        'formData.preguntas_id.*' => 'exists:preguntas,id',
        'formData.empresa_id' => 'required|exists:empresas,id',
        'formData.sucursal_id' => 'required|exists:sucursales,id'
    ];

    protected $messages = [
        'formData.encuestas_id.required' => 'Debe seleccionar una encuesta.',
        'formData.encuestas_id.exists' => 'La encuesta seleccionada no es válida.',
        'formData.preguntas_id.required' => 'Debe seleccionar al menos una pregunta.',
        'formData.preguntas_id.array' => 'Las preguntas deben ser un arreglo válido.',
        'formData.preguntas_id.min' => 'Debe seleccionar al menos una pregunta.',
        'formData.preguntas_id.*.exists' => 'Una o más preguntas seleccionadas no son válidas.',
        'formData.empresa_id.required' => 'Debe seleccionar una empresa.',
        'formData.empresa_id.exists' => 'La empresa seleccionada no es válida.',
        'formData.sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'formData.sucursal_id.exists' => 'La sucursal seleccionada no es válida.'
    ];

    public function mount()
    {
        $this->empresas = Empresa::select('id', 'nombre')->get();
        $this->encuestas = collect();
        $this->preguntas = collect();
        $this->sucursales = collect();
    }

    public function updatedFormDataEmpresaId($value)
    {
        // Reemplazar reset() con asignaciones directas
        $this->formData['encuestas_id'] = '';
        $this->formData['preguntas_id'] = [];
        $this->formData['sucursal_id'] = '';

        if (!empty($value)) {
            try {
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                $this->sucursales = $empresa->sucursales;
                $this->encuestas = Encuesta360::where('empresa_id', $value)
                    ->select('id', 'nombre')
                    ->get();
            } catch (\Exception $e) {
                Log::error('Error loading sucursales/encuestas: ' . $e->getMessage());
                $this->dispatch('toastr-error', message: 'Error al cargar datos: ' . $e->getMessage());
                $this->sucursales = collect();
                $this->encuestas = collect();
            }
        } else {
            $this->sucursales = collect();
            $this->encuestas = collect();
        }
        $this->preguntas = collect();
    }

    public function updatedFormDataSucursalId()
    {
        // Reemplazar reset() con asignaciones directas
        $this->formData['encuestas_id'] = '';
        $this->formData['preguntas_id'] = [];

        $this->preguntas = collect();
    }

    public function updatedFormDataEncuestasId()
    {
        $this->formData['preguntas_id'] = [];
        if (!empty($this->formData['empresa_id']) && !empty($this->formData['sucursal_id']) && !empty($this->formData['encuestas_id'])) {
            $this->preguntas = Pregunta::whereHas('respuestas', function ($query) {
                $query->where('empresa_id', $this->formData['empresa_id'])
                      ->where('sucursal_id', $this->formData['sucursal_id']);
            })
            ->select('id', 'texto')
            ->distinct()
            ->get();
        } else {
            $this->preguntas = collect();
        }
    }

    public function guardarAdministracion()
    {
        $this->validate();

        try {
            foreach ($this->formData['preguntas_id'] as $preguntaId) {
                $existe = Encpre::where('encuestas_id', $this->formData['encuestas_id'])
                              ->where('preguntas_id', $preguntaId)
                              ->exists();

                if ($existe) {
                    $this->dispatch('toastr-warning', message: "La pregunta con ID $preguntaId ya está asociada a esta encuesta.");
                    continue;
                }

                Encpre::create([
                    'encuestas_id' => $this->formData['encuestas_id'],
                    'preguntas_id' => $preguntaId,
                ]);
            }

            $this->reset('formData');
            $this->encuestas = collect();
            $this->preguntas = collect();
            $this->sucursales = collect();

            $this->dispatch('toastr-success', message: 'Relaciones guardadas correctamente.');
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador');
        } catch (\Exception $e) {
            Log::error('Error al guardar: ' . $e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al guardar: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-administrador.agregar-encuesta-pregunta-encpre-administrador')->layout('layouts.portal360');
    }
}
