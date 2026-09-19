<?php

namespace App\Livewire\PortalRh\Incidencias;

use Livewire\Component;
use App\Models\PortalRH\Incidencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;

class AgregarIncidencias extends Component
{
    public $incidencia = [], $sucursales=[], $departamentos=[], $users=[];
    public $empresas, $empresa, $sucursal, $departamento, $user_id;

    public function mount()
    {
        $this->empresas = Empresa::all();
    }

    public function updatedEmpresa()
    {
        $this->sucursales = Empresa::with('sucursales')->where('id', $this->empresa)->get();
    }

    public function updatedSucursal()
    {
        $this->departamentos = Sucursal::with('departamentos')->where('id', $this->sucursal)->get();
    }

    public function updatedDepartamento()
    {
        // Obtener los users del departamento seleccionado
        $this->users = Departamento::with('users')->where('id', $this->departamento)->get();
    }

    protected $rules = [
        'incidencia.tipo_incidencia' => 'required',
        'incidencia.fecha_inicio' => 'required|date',
        'incidencia.fecha_final' => 'required|date|after_or_equal:incidencia.fecha_inicio',

        'empresa' => 'required',
        'sucursal' => 'required',
        'departamento' => 'required',
        'user_id' => 'required|exists:users,id',
    ];

    protected $messages = [
        'incidencia.*.required' => 'Este campo es obligatorio.',
        'incidencia.fecha_final.after_or_equal' => 'La fecha final debe ser posterior o igual a la fecha de inicio.',

        'empresa.required' => 'Por favor seleccione una empresa.',
        'sucursal.required' => 'Por favor seleccione una sucursal.',
        'departamento.required' => 'Por favor seleccione un departamento.',
        'user_id.required' => 'Este campo es obligatorio.',
        'user_id.exists' => 'El usuario seleccionado no existe.',
    ];

    public function saveIncidencia()
    {
        $this->validate();
        $nuevaIncidencia = new Incidencia($this->incidencia);
        $nuevaIncidencia->save();

        // Asociar el usuario seleccionado en la tabla pivote
        $nuevaIncidencia->users()->attach($this->user_id);

        session()->flash('message', 'Incidencia agregada');
    }

    public function redirigirIncidencia()
    {
        return redirect()->route('mostrarincidencia');
    }

    public function render()
    {
        return view('livewire.portal-rh.incidencias.agregar-incidencias')->layout('layouts.client');
    }
}
