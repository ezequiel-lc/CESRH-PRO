<?php

namespace App\Livewire\PortalRh\Becario;

use Livewire\Component;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EditarBecario extends Component
{
    public $sucursales = [], $departamentos=[], $puestos = [], $user = [];
    
    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $sucursal,
    $departamento, $password;

    public $becario_id, 
        $clave_becario, 
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
        $fecha_ingreso, 
        $status, 
        $calle, 
        $colonia,
        
        $user_id,
        $registro_patronal_id
    ;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $becario = Becario::findOrFail($id);

        $this->becario_id = $id;
        $this->clave_becario = $becario->clave_becario;
        $this->numero_seguridad_social = $becario->numero_seguridad_social;
        $this->fecha_nacimiento = $becario->fecha_nacimiento;
        $this->lugar_nacimiento = $becario->lugar_nacimiento;
        $this->estado = $becario->estado;
        $this->codigo_postal = $becario->codigo_postal;
        $this->ocupacion = $becario->ocupacion;
        $this->sexo = $becario->sexo;
        $this->curp = $becario->curp;
        $this->rfc = $becario->rfc;
        $this->numero_celular = $becario->numero_celular;
        $this->fecha_ingreso = $becario->fecha_ingreso;
        $this->status = $becario->status;
        $this->calle = $becario->calle;
        $this->colonia = $becario->colonia;
        $this->registro_patronal_id = $becario->registro_patronal_id;
        $this->user_id = $becario->user_id;

        $this->becario = $becario->toArray();
        $this->user = User::findOrFail($becario->user_id)->toArray();
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

    public function actualizarBecario()
    {
        $this->validate([
            'clave_becario' => 'required',
            'numero_seguridad_social' => 'required',
            'fecha_nacimiento' => 'required|date',
            'lugar_nacimiento' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required|digits:5',
            'ocupacion' => 'required',
            'sexo' => 'required',
            'curp' => 'required|size:18',
            'rfc' => 'required|size:13',
            'numero_celular' => 'required|digits:10',
            'fecha_ingreso' => 'required|date',
            'status' => 'required',
            'calle' => 'required',
            'colonia' => 'required',
            'registro_patronal_id' => 'required|exists:registros_patronales,id',
            'user_id' => 'required|exists:users,id',
            
            'user.name' => 'required',
            'user.email' => 'required',
            'password' => 'nullable',
            'empresa' => 'required',
            'sucursal' => 'required',
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
            'tipo_user' => 'Becario',
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        Becario::updateOrCreate(['id' => $this->becario_id], [
            'clave_becario' => $this->clave_becario,
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
            'fecha_ingreso' => $this->fecha_ingreso,
            'status' => $this->status,
            'calle' => $this->calle,
            'colonia' => $this->colonia,
            
            'user_id' => $this->user_id,
            'registro_patronal_id' => $this->registro_patronal_id,
        ]);

        //session()->flash('message', 'Becario actualizado correctamente.');
        return redirect()->route('mostrarbecario');
    }

    public function render()
    {
        return view('livewire.portal-rh.becario.editar-becario')->layout('layouts.client');
    }
}
