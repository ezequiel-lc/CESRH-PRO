<?php

namespace App\Livewire\PortalRh\Incapacidad;

use Livewire\Component;
use App\Models\PortalRH\Incapacidad;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class AgregarIncapacidad extends Component
{
    use WithFileUploads;
    public $incapacidad = [], $documento;

    protected $rules = [
        'incapacidad.tipo' => 'required',
        'incapacidad.motivo' => 'required',
        'incapacidad.fecha_inicio' => 'required|date',
        'incapacidad.fecha_final' => 'required|date|after_or_equal:incapacidad.fecha_inicio',
        'documento' => 'required|file',
        'incapacidad.status' => 'required', 
        'incapacidad.observaciones' => 'nullable',
    ];

    protected $messages = [
        'incapacidad.*.required' => 'Este campo es obligatorio.',
        'incapacidad.fecha_final.after_or_equal' => 'La fecha final debe ser posterior o igual a la fecha de inicio.',
        'documento.required' => 'El archivo es requerido, solo formato PDF.',
        'documento.file' => 'Adjunta un archivo en formato PDF.',
    ];

    public function saveIncapacidad()
    {
        //dd();
        //$this->validate();
        $this->documento->storeAs('PortalRH/Incapacidades', $this->incapacidad['motivo'].".pdf", 'subirDocs');
        $this->incapacidad['documento'] = "PortalRH/Incapacidades/" . $this->incapacidad['motivo'] .".pdf";

        // Crear incidencia con status 'Pendiente'
        $nuevaIncapacidad = new Incapacidad($this->incapacidad);
        $nuevaIncapacidad->status = 'Pendiente';
        $nuevaIncapacidad->save();

        // Asociar el usuario en la tabla pivote
        $nuevaIncapacidad->users()->attach(Auth::id());

        session()->flash('message', 'Incapacidad enviada para aprobación.');
    }

    public function redirigirIncapacidad()
    {
        return redirect()->route('mostrarincapacidad');
    }

    public function render()
    {
        return view('livewire.portal-rh.incapacidad.agregar-incapacidad')->layout('layouts.client');
    }
}
