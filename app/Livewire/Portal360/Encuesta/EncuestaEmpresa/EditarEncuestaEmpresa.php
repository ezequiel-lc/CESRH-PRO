<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaEmpresa;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarEncuestaEmpresa extends Component
{

    public $encuestaId;
    public $encuesta = [
        'nombre' => '',
        'descripcion' => '',
        'indicaciones' => '',
        'sucursal_id' => '',
        'empresa_id' => null, // Mantener consistencia con AgregarEncuestaEmpresa
    ];
    public $sucursales = [];

    protected $rules = [
        'encuesta.nombre' => 'required|min:3',
        'encuesta.descripcion' => 'required|min:5',
        'encuesta.indicaciones' => 'required|min:5',
        'encuesta.sucursal_id' => 'required|exists:sucursales,id',
    ];

    protected $messages = [
        'encuesta.nombre.required' => 'El nombre es obligatorio y debe tener al menos 3 caracteres.',
        'encuesta.descripcion.required' => 'La descripción es obligatoria y debe tener al menos 5 caracteres.',
        'encuesta.indicaciones.required' => 'Las indicaciones son obligatorias y deben tener al menos 5 caracteres.',
        'encuesta.sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'encuesta.sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
    ];

    public function mount($id)
    {
        $this->encuestaId = Crypt::decrypt($id);
        $encuesta = Encuesta360::findOrFail($this->encuestaId);
        $this->encuesta = $encuesta->toArray();

        // Cargar sucursales de la empresa del usuario autenticado (como en AgregarEncuestaEmpresa)
        $this->encuesta['empresa_id'] = Auth::user()->empresa_id;
        $empresa = Empresa::find($this->encuesta['empresa_id']);
        $this->sucursales = $empresa->sucursales()
            ->select('sucursales.id', 'sucursales.nombre_sucursal')
            ->get();
    }

    public function saveEncuestaEmpresa()
    {
        $this->validate();

        try {
            $encuesta = Encuesta360::findOrFail($this->encuestaId);
            $encuesta->update($this->encuesta);

            $this->dispatch('toastr-success', message: 'Encuesta Actualizada Correctamente.');
            return redirect()->route('portal360.encuesta.encuesta-empresa.mostrar-encuesta-empresa');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al actualizar la encuesta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-empresa.editar-encuesta-empresa')->layout('layouts.portal360');
    }
}
