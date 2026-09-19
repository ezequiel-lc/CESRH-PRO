<?php

namespace App\Livewire\PortalRh\CambioSalario;

use Livewire\Component;
use App\Models\PortalRH\CambioSalario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;
use Livewire\WithFileUploads;

class AgregarCambioSalario extends Component
{
    use WithFileUploads;
    public $salario = [], $sucursales=[], $departamentos=[], $users=[];
    public $empresas, $empresa, $sucursal, $departamento, $user_id, $documento;

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
        'salario.fecha_cambio' => 'required|date',
        'salario.salario_anterior' => 'required|numeric',
        'salario.salario_nuevo' => 'required|numeric',
        'salario.motivo' => 'required',
        'salario.observaciones' => 'required',
        'documento' => 'required|file',

        'empresa' => 'required',
        'sucursal' => 'required',
        'departamento' => 'required',
        'user_id' => 'required|exists:users,id',
    ];

    protected $messages = [
        'salario.*.required' => 'Este campo es obligatorio.',
        'salario.salario_anterior.decimal' => 'Ingrese solo números.',
        'salario.salario_nuevo.decimal' => 'Ingrese solo números.',
        'documento.file' => 'Adjunta un archivo en formato PDF.',

        'empresa.required' => 'Por favor seleccione una empresa.',
        'sucursal.required' => 'Por favor seleccione una sucursal.',
        'departamento.required' => 'Por favor seleccione un departamento.',
        'user_id.required' => 'Este campo es obligatorio.',
        'user_id.exists' => 'El usuario seleccionado no existe.',
    ];

    public function saveSalario()
    {
        $this->validate();
        $this->documento->storeAs('PortalRH/CambioSalario', $this->salario['motivo'].".pdf", 'subirDocs');
        $this->salario['documento'] = "PortalRH/CambioSalario/" . $this->salario['motivo'] .".pdf";

        $nuevoSalario = new CambioSalario($this->salario);
        $nuevoSalario->save();

        // Asociar el usuario seleccionado en la tabla pivote
        $nuevoSalario->users()->attach($this->user_id);

        $this->salario = [];
        $this->documento=NULL;

        session()->flash('message', 'Cambio de salario agregado');
    }

    public function redirigirSalario()
    {
        return redirect()->route('mostrarcambiosal');
    }

    public function render()
    {
        return view('livewire.portal-rh.cambio-salario.agregar-cambio-salario')->layout('layouts.client');
    }
}
