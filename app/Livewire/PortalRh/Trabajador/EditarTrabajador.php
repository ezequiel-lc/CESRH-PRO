<?php

namespace App\Livewire\PortalRh\Trabajador;

use Livewire\Component;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class EditarTrabajador extends Component
{
    public $sucursales = [], $departamentos=[], $puestos = [], $user = [];
    
    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $sucursal,
    $departamento, $password;

    public $trabajador_id, 
        $clave_trabajador, 
        $numero_seguridad_social, 
        $fecha_nacimiento, 
        $lugar_nacimiento, 
        $estado, 
        $codigo_postal, 
        $sexo, 
        $curp, 
        $rfc, 
        $numero_celular, 
        $fecha_ingreso, 
        $edad, 
        $estado_civil, 
        $estudios, 
        $ocupacion, 
        $tipo_puest, 
        $contratacion, 
        $tipo_personal, 
        $jornada_trabajo, 
        $rotacion, 
        $experiencia, 
        $tiempo_puesto, 
        $calle, 
        $colonia, 
        $numero, 
        $status, 

        $user_id,
        $registro_patronal_id
    ;


    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $trabajador = Trabajador::findOrFail($id);
        
        $this->trabajador_id = $id;
        $this->clave_trabajador = $trabajador->clave_trabajador;
        $this->numero_seguridad_social = $trabajador->numero_seguridad_social;
        $this->fecha_nacimiento = $trabajador->fecha_nacimiento;
        $this->lugar_nacimiento = $trabajador->lugar_nacimiento;
        $this->estado = $trabajador->estado;
        $this->codigo_postal = $trabajador->codigo_postal;
        $this->sexo = $trabajador->sexo;
        $this->curp = $trabajador->curp;
        $this->rfc = $trabajador->rfc;
        $this->numero_celular = $trabajador->numero_celular;
        $this->fecha_ingreso = $trabajador->fecha_ingreso;
        $this->edad = $trabajador->edad;
        $this->estado_civil = $trabajador->estado_civil;
        $this->estudios = $trabajador->estudios;
        $this->ocupacion = $trabajador->ocupacion;
        $this->tipo_puest = $trabajador->tipo_puest;
        $this->contratacion = $trabajador->contratacion;
        $this->tipo_personal = $trabajador->tipo_personal;
        $this->jornada_trabajo = $trabajador->jornada_trabajo;
        $this->rotacion = $trabajador->rotacion;
        $this->experiencia = $trabajador->experiencia;
        $this->tiempo_puesto = $trabajador->tiempo_puesto;
        $this->calle = $trabajador->calle;
        $this->colonia = $trabajador->colonia;
        $this->numero = $trabajador->numero;
        $this->status = $trabajador->status;
        $this->registro_patronal_id = $trabajador->registro_patronal_id;
        $this->user_id = $trabajador->user_id;

        $this->trabajador = $trabajador->toArray();
        $this->user = User::findOrFail($trabajador->user_id)->toArray();
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

    public function actualizarTrabajador()
    {
        $this->validate([
            'clave_trabajador' => 'required',
            'numero_seguridad_social' => 'required',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required|digits:5',
            'sexo' => 'required',
            'curp' => 'required|size:18',
            'rfc' => 'nullable|size:13',
            'numero_celular' => 'required|digits:10',
            'fecha_ingreso' => 'required',
            'edad' => 'required',
            'estado_civil' => 'required',
            'estudios' => 'required',
            'ocupacion' => 'required',
            'tipo_puest' => 'required',
            'contratacion' => 'required',
            'tipo_personal' => 'required',
            'jornada_trabajo' => 'required',
            'rotacion' => 'required',
            'experiencia' => 'required',
            'tiempo_puesto' => 'required',
            'calle' => 'required',
            'colonia' => 'required',
            'numero' => 'required',
            'status' => 'required',
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
            'tipo_user' => 'Trabajador',
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        Trabajador::updateOrCreate(['id' => $this->trabajador_id], [
            'clave_trabajador' => $this->clave_trabajador,
            'numero_seguridad_social' => $this->numero_seguridad_social,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_nacimiento' => $this->lugar_nacimiento,
            'estado' => $this->estado,
            'codigo_postal' => $this->codigo_postal,
            'sexo' => $this->sexo,
            'curp' => $this->curp,
            'rfc' => $this->rfc,
            'numero_celular' => $this->numero_celular,
            'fecha_ingreso' => $this->fecha_ingreso,
            'edad' => $this->edad,
            'estado_civil' => $this->estado_civil,
            'estudios' => $this->estudios,
            'ocupacion' => $this->ocupacion,
            'tipo_puest' => $this->tipo_puest,
            'contratacion' => $this->contratacion,
            'tipo_personal' => $this->tipo_personal,
            'jornada_trabajo' => $this->jornada_trabajo,
            'rotacion' => $this->rotacion,
            'experiencia' => $this->experiencia,
            'tiempo_puesto' => $this->tiempo_puesto,
            'calle' => $this->calle,
            'colonia' => $this->colonia,
            'numero' => $this->numero,
            'status' => $this->status,

            'user_id' => $this->user_id,
            'registro_patronal_id' => $this->registro_patronal_id,
        ]);

        return redirect()->route('mostrartrabajador')->with('message', 'Trabajador actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-rh.trabajador.editar-trabajador')->layout('layouts.client');
    }
}
