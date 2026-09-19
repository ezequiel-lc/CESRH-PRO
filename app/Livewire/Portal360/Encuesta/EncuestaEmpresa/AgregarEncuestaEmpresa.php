<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaEmpresa;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AgregarEncuestaEmpresa extends Component
{

    public $encuesta = [
        'nombre' => '',
        'descripcion' => '',
        'indicaciones' => '',
        'sucursal_id' => '',
        'empresa_id' => null, // Inicializamos como null, se establecerá dinámicamente
    ];

    public $sucursales = [];


    public function mount()
{
    // Obtener el empresa_id del usuario autenticado
    $this->encuesta['empresa_id'] = Auth::user()->empresa_id;

    // Cargar sucursales a través de la relación con Empresa
    $empresa = Empresa::find($this->encuesta['empresa_id']);
    $this->sucursales = $empresa->sucursales()
        ->select('sucursales.id', 'sucursales.nombre_sucursal')
        ->get();

}


    protected $rules = [
        'encuesta.nombre' => 'required|min:3',
        'encuesta.descripcion' => 'required|min:5',
        'encuesta.indicaciones' => 'required|min:5',
        'encuesta.sucursal_id' => 'required|exists:sucursales,id',
    ];

    protected $messages = [
        'encuesta.nombre.required' => 'El nombre es obligatorio y debe tener al menos 3 caracteres.',
        'encuesta.descripcion.required' => 'La descripción es obligatoria y debe tener al menos 5 caracteres.',
        'encuesta.indicaciones.required' => 'Las indicaciones son obligatorias y debe tener al menos 5 caracteres.',
        'encuesta.sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'encuesta.sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
    ];


    public function saveEncuestaEmpresa()
    {
        $this->validate();

        try {
            $this->encuesta['empresa_id'] = Auth::user()->empresa_id;
            $nuevaEncuesta = new Encuesta360($this->encuesta);
            $nuevaEncuesta->save();

            $this->encuesta = [
                'nombre' => '',
                'descripcion' => '',
                'indicaciones' => '',
                'sucursal_id' => '',
                'empresa_id' => Auth::user()->empresa_id, // Mantener el empresa_id del usuario
            ];

            $this->dispatch('toastr-success', message: 'Encuesta Guardada Correctamente.');

            return redirect()->route('portal360.encuesta.encuesta-empresa.mostrar-encuesta-empresa');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al guardar la encuesta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-empresa.agregar-encuesta-empresa')->layout('layouts.portal360');
    }
}
