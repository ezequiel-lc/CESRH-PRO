<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador;

use App\Models\Encuestas360\Encpre;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Pregunta;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditarEncuestaPreguntaEncpreAdministrador extends Component
{
    public $encpreId;
    public $formData = [
        'encuestas_id' => '',
        'preguntas_id' => [],
        'empresa_id' => '',
        'sucursal_id' => ''
    ];

    public $empresas = [];
    public $encuestas = [];
    public $preguntas = [];
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

    public function mount($id)
    {
        try {
            $this->encpreId = Crypt::decrypt($id);
            $encpre = Encpre::with(['encuesta', 'encuesta.empresa.sucursales'])->findOrFail($this->encpreId);

            // Cargar todas las empresas
            $this->empresas = Empresa::select('id', 'nombre')->get();

            // Inicializar datos del formulario
            $this->formData = [
                'empresa_id' => $encpre->encuesta->empresa_id,
                'sucursal_id' => $encpre->encuesta->sucursal_id,
                'encuestas_id' => $encpre->encuestas_id,
                'preguntas_id' => Encpre::where('encuestas_id', $encpre->encuestas_id)
                    ->pluck('preguntas_id')
                    ->toArray()
            ];

            // Cargar sucursales de la empresa seleccionada
            $empresa = Empresa::with('sucursales')->find($this->formData['empresa_id']);
            $this->sucursales = $empresa ? $empresa->sucursales : collect();

            // Cargar encuestas de la empresa
            $this->encuestas = Encuesta360::where('empresa_id', $this->formData['empresa_id'])
                ->where('sucursal_id', $this->formData['sucursal_id'])
                ->select('id', 'nombre')
                ->get();

            // Cargar todas las preguntas disponibles para la empresa
            $this->preguntas = Pregunta::whereHas('respuestas', function ($query) {
                $query->where('empresa_id', $this->formData['empresa_id']);
            })
                ->select('id', 'texto')
                ->distinct()
                ->get();

        } catch (\Exception $e) {
            Log::error('Error loading data: ' . $e->getMessage());
            session()->flash('error', 'Error al cargar los datos: ' . $e->getMessage());
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador');
        }
    }

    public function updatedFormDataEmpresaId($value)
    {
        $this->formData['sucursal_id'] = '';
        $this->formData['encuestas_id'] = '';
        $this->formData['preguntas_id'] = [];
        
        $this->sucursales = collect();
        $this->encuestas = collect();
        $this->preguntas = collect();

        if (!empty($value)) {
            try {
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                $this->sucursales = $empresa->sucursales;
                
                $this->preguntas = Pregunta::whereHas('respuestas', function ($query) use ($value) {
                    $query->where('empresa_id', $value);
                })
                    ->select('id', 'texto')
                    ->distinct()
                    ->get();
            } catch (\Exception $e) {
                Log::error('Error loading sucursales: ' . $e->getMessage());
                $this->dispatch('toastr-error', message: 'Error al cargar sucursales');
            }
        }
    }

    public function updatedFormDataSucursalId($value)
    {
        $this->formData['encuestas_id'] = '';
        $this->formData['preguntas_id'] = [];
        $this->encuestas = collect();

        if (!empty($value) && !empty($this->formData['empresa_id'])) {
            try {
                $this->encuestas = Encuesta360::where('empresa_id', $this->formData['empresa_id'])
                    ->where('sucursal_id', $value)
                    ->select('id', 'nombre')
                    ->get();
            } catch (\Exception $e) {
                Log::error('Error loading encuestas: ' . $e->getMessage());
                $this->dispatch('toastr-error', message: 'Error al cargar encuestas');
            }
        }
    }

    public function updatedFormDataEncuestasId($value)
    {
        $this->formData['preguntas_id'] = [];

        if (!empty($value)) {
            try {
                // Cargar preguntas asociadas a esta encuesta
                $existingPreguntas = Encpre::where('encuestas_id', $value)
                    ->pluck('preguntas_id')
                    ->toArray();
                $this->formData['preguntas_id'] = $existingPreguntas;
            } catch (\Exception $e) {
                Log::error('Error loading preguntas: ' . $e->getMessage());
                $this->dispatch('toastr-error', message: 'Error al cargar preguntas');
            }
        }
    }

    public function actualizarAdministrador()
    {
        $this->validate();

        try {
            // Eliminar relaciones existentes
            Encpre::where('encuestas_id', $this->formData['encuestas_id'])->delete();

            // Crear nuevas relaciones
            foreach ($this->formData['preguntas_id'] as $preguntaId) {
                Encpre::create([
                    'encuestas_id' => $this->formData['encuestas_id'],
                    'preguntas_id' => $preguntaId,
                ]);
            }

            $this->dispatch('toastr-success', message: 'Relación actualizada correctamente.');
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador');
        } catch (\Exception $e) {
            Log::error('Error al actualizar: ' . $e->getMessage());
            $this->dispatch('toastr-error', message: 'Error al actualizar: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-administrador.editar-encuesta-pregunta-encpre-administrador')->layout('layouts.portal360');
    }
}
