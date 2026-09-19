<?php

namespace App\Livewire\PortalRh\Instructor;

use Livewire\Component;
use App\Models\PortalRH\Instructor;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EditarInstructor extends Component
{
    public $sucursales = [], $departamentos=[], $puestos = [], $user = [];
    
    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $sucursal,
    $departamento, $password;

    public $instructor_id, 
        $telefono1, 
        $telefono2, 
        $registroStps, 
        $rfc, 
        $regimen, 
        $estado, 
        $municipio, 
        $codigopostal, 
        $colonia, 
        $calle, 
        $numero, 
        $honorarios, 
        $status, 
        $dc5, 
        $cuentabancaria, 
        $ine, 
        $curp, 
        $sat, 
        $domicilio, 
        $tipoinstructor, 
        $nombre_empresa, 
        $rfc_empre, 
        $calle_empre, 
        $numero_empre, 
        $colonia_empre, 
        $municipio_empre, 
        $estado_empre,
        $postal_empre,
        $regimen_empre,
        
        $user_id,
        $registro_patronal_id
    ;
    

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $instructor = Instructor::findOrFail($id);
        
        $this->instructor_id = $id;
        $this->telefono1 = $instructor->telefono1;
        $this->telefono2 = $instructor->telefono2;
        $this->registroStps = $instructor->registroStps;
        $this->rfc = $instructor->rfc;
        $this->regimen = $instructor->regimen;
        $this->estado = $instructor->estado;
        $this->municipio = $instructor->municipio;
        $this->codigopostal = $instructor->codigopostal;
        $this->colonia = $instructor->colonia;
        $this->calle = $instructor->calle;
        $this->numero = $instructor->numero;
        $this->honorarios = $instructor->honorarios;
        $this->status = $instructor->status;
        $this->dc5 = $instructor->dc5;
        $this->cuentabancaria = $instructor->cuentabancaria;
        $this->ine = $instructor->ine;
        $this->curp = $instructor->curp;
        $this->sat = $instructor->sat;
        $this->domicilio = $instructor->domicilio;
        $this->tipoinstructor = $instructor->tipoinstructor;
        $this->nombre_empresa = $instructor->nombre_empresa;
        $this->rfc_empre = $instructor->rfc_empre;
        $this->calle_empre = $instructor->calle_empre;
        $this->numero_empre = $instructor->numero_empre;
        $this->colonia_empre = $instructor->colonia_empre;
        $this->municipio_empre = $instructor->municipio_empre;
        $this->estado_empre = $instructor->estado_empre;
        $this->postal_empre = $instructor->postal_empre;
        $this->regimen_empre = $instructor->regimen_empre;
        $this->registro_patronal_id = $instructor->registro_patronal_id;
        $this->user_id = $instructor->user_id;

        $this->instructor = $instructor->toArray();
        $this->user = User::findOrFail($instructor->user_id)->toArray();
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

    public function actualizarInstructor()
    {
        $this->validate([
            'telefono1' => 'required|digits:10',
            'telefono2' => 'required|digits:10',
            'registroStps' => 'required',
            'rfc' => 'nullable|size:13',
            'regimen' => 'required',
            'estado' => 'required',
            'municipio' => 'required',
            'codigopostal' => 'required|digits:5',
            'colonia' => 'required',
            'calle' => 'required',
            'numero' => 'required',
            'honorarios' => 'required',
            'status' => 'required',
            'dc5' => 'required',
            'cuentabancaria' => 'required',
            'ine' => 'required',
            'curp' => 'required|size:18', //|size:18
            'sat' => 'required',
            'domicilio' => 'required',
            'tipoinstructor' => 'required',
            'nombre_empresa' => 'required',
            'rfc_empre' => 'required|size:13',
            'calle_empre' => 'required',
            'numero_empre' => 'required',
            'colonia_empre' => 'required',
            'municipio_empre' => 'required',
            'estado_empre' => 'required',
            'postal_empre' => 'required|digits:5',
            'regimen_empre' => 'required',
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
            'tipo_user' => 'Instructor',
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        Instructor::updateOrCreate(['id' => $this->instructor_id], [
            'telefono1' => $this->telefono1,
            'telefono2' => $this->telefono2,
            'registroStps' => $this->registroStps,
            'rfc' => $this->rfc,
            'regimen' => $this->regimen,
            'estado' => $this->estado,
            'estado' => $this->estado,
            'municipio' => $this->municipio,
            'codigopostal' => $this->codigopostal,
            'colonia' => $this->colonia,
            'calle' => $this->calle,
            'numero' => $this->numero,
            'honorarios' => $this->honorarios,
            'status' => $this->status,
            'dc5' => $this->dc5,
            'cuentabancaria' => $this->cuentabancaria,
            'ine' => $this->ine,
            'curp' => $this->curp,
            'sat' => $this->sat,  
            'domicilio' => $this->domicilio,
            'tipoinstructor' => $this->tipoinstructor,
            'nombre_empresa' => $this->nombre_empresa,
            'rfc_empre' => $this->rfc_empre,
            'calle_empre' => $this->calle_empre,
            'numero_empre' => $this->numero_empre,
            'colonia_empre' => $this->colonia_empre,
            'municipio_empre' => $this->municipio_empre,
            'estado_empre' => $this->estado_empre,
            'postal_empre' => $this->postal_empre,
            'regimen_empre' => $this->regimen_empre,
            
            'user_id' => $this->user_id,
            'registro_patronal_id' => $this->registro_patronal_id,
        ]);

        return redirect()->route('mostrarinstructor')->with('message', 'Instructor actualizado correctamente.');
    }


    public function render()
    {
        return view('livewire.portal-rh.instructor.editar-instructor')->layout('layouts.client');
    }
}
