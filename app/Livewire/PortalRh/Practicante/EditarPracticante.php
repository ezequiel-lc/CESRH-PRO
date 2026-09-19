<?php

namespace App\Livewire\PortalRh\Practicante;

use Livewire\Component;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EditarPracticante extends Component
{
    public $sucursales = [], $departamentos=[], $puestos = [], $user = [];
    
    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $sucursal,
    $departamento, $password;

    public $practicante_id, 
        $clave_practicante, 
        $numero_seguridad_social, 
        $fecha_nacimiento, 
        $lugar_nacimiento, 
        $estado, 
        $codigo_postal, 
        $ocupacion,
        $sexo, 
        $curp, 
        $rfc, 
        $numero_celular, 
        
        $user_id,
        $registro_patronal_id
    ;
    


    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $practicante = Practicante::findOrFail($id);
        
        $this->practicante_id = $id;
        $this->clave_practicante = $practicante->clave_practicante;
        $this->numero_seguridad_social = $practicante->numero_seguridad_social;
        $this->fecha_nacimiento = $practicante->fecha_nacimiento;
        $this->lugar_nacimiento = $practicante->lugar_nacimiento;
        $this->estado = $practicante->estado;
        $this->codigo_postal = $practicante->codigo_postal;
        $this->ocupacion = $practicante->ocupacion;
        $this->sexo = $practicante->sexo;
        $this->curp = $practicante->curp;
        $this->rfc = $practicante->rfc;
        $this->numero_celular = $practicante->numero_celular;
        $this->registro_patronal_id = $practicante->registro_patronal_id;
        $this->user_id = $practicante->user_id;

        $this->practicante = $practicante->toArray();
        $this->user = User::findOrFail($practicante->user_id)->toArray();
        $this->empresa = $this->user['empresa_id'] ?? null;
        $this->sucursal = $this->user['sucursal_id'] ?? null;
        $this->departamento = $this->user['departamento_id'] ?? null;

        $this->usuarios = User::all();
        $this->registros_patronales = RegistroPatronal::all();
        $this->empresas = Empresa::all();

        $this->updatedEmpresa();
        $this->updatedDepartamento();
        $this->updatedSucursal();
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
        $this->puestos = Departamento::with('puestos')->where('id', $this->departamento)->get();
    }

    public function actualizarPracticante()
    {
        $this->validate([
            'clave_practicante' => 'required',
            'numero_seguridad_social' => 'required',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required|digits:5',
            'ocupacion' => 'required',
            'sexo' => 'required',
            'curp' => 'required|size:18',
            'rfc' => 'required|size:13',
            'numero_celular' => 'required|digits:10',
            'registro_patronal_id' => 'required|exists:registros_patronales,id',
            'user_id' => 'required|exists:users,id',
            
            'user.name' => 'required',
            'user.email' => 'required',
            'password' => 'nullable',
            'empresa' => 'required',
            'user.sucursal_id' => 'required|exists:sucursales,id',
            'departamento' => 'required',
            'user.puesto_id' => 'required|exists:puestos,id',
            
        ]);

        $user = User::findOrFail($this->user['id']);
        $user->update([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'empresa_id' => $this->empresa,
            'departamento_id' => $this->departamento,
            'sucursal_id' => $this->sucursal,
            'puesto_id' => $this->user['puesto_id'],
            'tipo_user' => 'Practicante',
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        Practicante::updateOrCreate(['id' => $this->practicante_id], [
            'clave_practicante' => $this->clave_practicante,
            'numero_seguridad_social' => $this->numero_seguridad_social,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_nacimiento' => $this->lugar_nacimiento,
            'estado' => $this->estado,
            'codigo_postal' => $this->codigo_postal,
            'ocupacion' => $this->ocupacion,
            'sexo' => $this->sexo,
            'curp' => $this->curp,
            'rfc' => $this->rfc,
            'numero_celular' => $this->numero_celular,
            
            'user_id' => $this->user_id,
            'registro_patronal_id' => $this->registro_patronal_id,
        ]);

        //$this->dispatch('toastr-success', message: 'Becario actualizado correctamente.');
        //$this->emit('message', 'Becario actualizado correctamente.');
        return redirect()->route('mostrarpracticante');
    }

    public function render()
    {
        return view('livewire.portal-rh.practicante.editar-practicante')->layout('layouts.client');
    }
}
