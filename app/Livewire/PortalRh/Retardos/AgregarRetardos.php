<?php

namespace App\Livewire\PortalRh\Retardos;

use Livewire\Component;
use App\Models\PortalRH\Retardo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;

class AgregarRetardos extends Component
{
    public $retardo = [], $sucursales=[], $departamentos=[], $users=[];
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
        'retardo.fecha' => 'required|date',
        'retardo.hora_entrada_programada' => 'required',
        'retardo.hora_entrada_real' => 'required',
        'retardo.minutos_retardo' => 'required',
        'retardo.motivo' => 'required',
        'retardo.status' => 'required',

        'empresa' => 'required',
        'sucursal' => 'required',
        'departamento' => 'required',
        'user_id' => 'required|exists:users,id',
    ];

    protected $messages = [
        'retardo.*.required' => 'Este campo es obligatorio.',

        'empresa.required' => 'Por favor seleccione una empresa.',
        'sucursal.required' => 'Por favor seleccione una sucursal.',
        'departamento.required' => 'Por favor seleccione un departamento.',
        'user_id.required' => 'Este campo es obligatorio.',
        'user_id.exists' => 'El usuario seleccionado no existe.',
    ];

    public function saveRetardo()
    {
        $this->validate();
        $nuevoRetardo = new Retardo($this->retardo);
        $nuevoRetardo->save();

        // Asociar el usuario seleccionado en la tabla pivote
        $nuevoRetardo->users()->attach($this->user_id);

        session()->flash('message', 'Retardo agregado');
    }

    public function redirigirRetardo()
    {
        return redirect()->route('mostrarretardo');
    }

    public function render()
    {
        return view('livewire.portal-rh.retardos.agregar-retardos')->layout('layouts.client');
    }
}
