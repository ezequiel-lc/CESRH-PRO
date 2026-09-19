<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaAdministrador;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarEncuestaAdministrador extends Component
{
    public $encuestaId;
    public $encuesta;
    public $empresas = [];
    public $sucursales = [];
    public $usuarios = [];

    protected $rules = [
        'encuesta.nombre' => 'required|string|max:255',
        'encuesta.descripcion' => 'required|string',
        'encuesta.indicaciones' => 'required|string',
        'encuesta.empresa_id' => 'required|exists:empresas,id',
        'encuesta.sucursal_id' => 'required|exists:sucursales,id',
    ];

    protected $messages = [
        'encuesta.nombre.required' => 'El nombre es obligatorio.',
        'encuesta.descripcion.required' => 'La descripción es obligatoria.',
        'encuesta.indicaciones.required' => 'Las indicaciones son obligatorias.',
        'encuesta.empresa_id.required' => 'Debe seleccionar una empresa.',
        'encuesta.empresa_id.exists' => 'La empresa seleccionada no es válida.',
        'encuesta.sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'encuesta.sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
    ];

    public function mount($id)
    {
        $this->encuestaId = Crypt::decrypt($id);
        $this->encuesta = Encuesta360::find($this->encuestaId)->toArray();
        $this->empresas = Empresa::select('id', 'nombre')->get();
        
        // Cargar las sucursales de la empresa actual
        if (!empty($this->encuesta['empresa_id'])) {
            $empresa = Empresa::with('sucursales')->find($this->encuesta['empresa_id']);
            $this->sucursales = $empresa->sucursales;
        }

        // Cargar usuarios si hay una sucursal seleccionada
        if (!empty($this->encuesta['sucursal_id'])) {
            $this->usuarios = User::where('sucursal_id', $this->encuesta['sucursal_id'])
                ->where('empresa_id', $this->encuesta['empresa_id'])
                ->get();
        }
    }

    public function updatedEncuestaEmpresaId($value)
    {
        if (!empty($value)) {
            try {
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                $this->sucursales = $empresa->sucursales;
                $this->encuesta['sucursal_id'] = '';
                $this->usuarios = collect();
                
                $this->dispatch('toastr-success', message: 'Sucursales cargadas correctamente.');
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar las sucursales: ' . $e->getMessage());
                $this->sucursales = collect();
            }
        } else {
            $this->sucursales = collect();
            $this->encuesta['sucursal_id'] = '';
            $this->usuarios = collect();
        }
    }

    public function updatedEncuestaSucursalId($value)
    {
        if (!empty($value)) {
            try {
                $this->usuarios = User::where('sucursal_id', $value)
                    ->where('empresa_id', $this->encuesta['empresa_id'])
                    ->get();
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar los usuarios: ' . $e->getMessage());
                $this->usuarios = collect();
            }
        } else {
            $this->usuarios = collect();
        }
    }

    public function saveEncuestaAdministrador()
    {
        $this->validate();

        try {
            $encuesta = Encuesta360::find($this->encuestaId);
            $encuesta->update($this->encuesta);

            $this->dispatch('toastr-success', message: 'Encuesta Actualizada Correctamente.');

            return redirect()->route('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al actualizar la encuesta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-administrador.editar-encuesta-administrador')->layout('layouts.portal360');
    }
}
