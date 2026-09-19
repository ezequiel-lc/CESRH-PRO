<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaSucursal;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarEncuestaSucursal extends Component
{

    public $encuesta = [
        'nombre' => '',
        'descripcion' => '',
        'indicaciones' => '',
    ];


    public function mount()
    {
        $this->encuesta['empresa_id'] = Auth::user()->empresa_id;
        $this->encuesta['sucursal_id'] = Auth::user()->sucursal_id;     
        //dd($this->encuesta['sucursal_id']);   // Load companies when component is mounted
      
    }

    protected $rules = [
        'encuesta.nombre' => 'required|min:3',
        'encuesta.descripcion' => 'required|min:5',
        'encuesta.indicaciones' => 'required|min:5',
    ];

    protected $messages = [
        'encuesta.nombre.required' => 'El nombre es obligatorio y debe tener al menos 3 caracteres.',
        'encuesta.descripcion.required' => 'La descripción es obligatoria y debe tener al menos 5 caracteres.',
        'encuesta.indicaciones.required' => 'Las indicaciones son obligatorias y deben tener al menos 5 caracteres.',

    ];

    public function saveEncuestaSucursal()
    {
        $this->validate();

        try {
            $nuevaEncuesta = new Encuesta360($this->encuesta);
            $nuevaEncuesta->save();

            $this->encuesta = [
                'nombre' => '',
                'descripcion' => '',
                'indicaciones' => '',
            ];

            $this->dispatch('toastr-success', message: 'Encuesta Guardada Correctamente.');

            return redirect()->route('portal360.encuesta.encuesta-sucursal.mostrar-encuesta-sucursal');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al guardar la encuesta: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-sucursal.agregar-encuesta-sucursal')->layout('layouts.portal360');
    }
}
