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
use Illuminate\Support\Facades\Hash;

class AgregarInstructor extends Component
{
    public $instructor = [], $sucursales=[], $departamentos=[], $puestos=[], $user=[];

    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $nombre, $apellido_p, $apellido_m, $password,
    $sucursal, $departamento;

    public function mount()
    {
        $this->usuarios = User::all();
        $this->registros_patronales = RegistroPatronal::all();
        $this->empresas = Empresa::all();
    }

    public function updatedEmpresa()
    {
        //dd();
        $this->sucursales = Empresa::with('sucursales')->where('id', $this->empresa)->get();
    }

    public function updatedSucursal()
    {
        $this->departamentos = Sucursal::with('departamentos')->where('id', $this->sucursal)->get();
    }

    public function updatedDepartamento()
    {
        // Obtener los puestos del departamento seleccionado
        $this->puestos = Departamento::with('puestos')->where('id', $this->departamento)->get();
    }

    protected $rules = [
        'instructor.telefono1' => 'required|digits:10',
        'instructor.telefono2' => 'required|digits:10',
        'instructor.registroStps' => 'required',
        'instructor.rfc' => 'required|size:13|unique:instructores,rfc',
        'instructor.regimen' => 'required',
        'instructor.estado' => 'required',
        'instructor.municipio' => 'required',
        'instructor.codigopostal' => 'required|digits:5',
        'instructor.colonia' => 'required',
        'instructor.calle' => 'required',
        'instructor.numero' => 'required',
        'instructor.honorarios' => 'required',
        'instructor.status' => 'required',
        'instructor.dc5' => 'required',
        'instructor.cuentabancaria' => 'required|digits:16|unique:instructores,cuentabancaria',
        'instructor.ine' => 'required',
        'instructor.curp' => 'required|size:18|unique:instructores,curp', //|size:18
        'instructor.sat' => 'required',
        'instructor.domicilio' => 'required',
        'instructor.tipoinstructor' => 'required',
        'instructor.nombre_empresa' => 'required',
        'instructor.rfc_empre' => 'required|size:13',
        'instructor.calle_empre' => 'required',
        'instructor.numero_empre' => 'required',
        'instructor.colonia_empre' => 'required',
        'instructor.municipio_empre' => 'required',
        'instructor.estado_empre' => 'required',
        'instructor.postal_empre' => 'required|digits:5',
        'instructor.regimen_empre' => 'required',
        'instructor.registro_patronal_id' => 'required|exists:registros_patronales,id',
        
        'nombre' => 'required',
        'apellido_p' => 'required',
        'apellido_m' => 'required',
        'user.email' => 'required|unique:users,email',
        'password' => 'required',
        'empresa' => 'required',
        'sucursal' => 'required',
        'departamento' => 'required',
        'user.puesto_id' => 'required|exists:puestos,id',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'instructor.*.required' => 'Este campo es obligatorio',
        'instructor.codigopostal.digits' => 'El código postal debe tener 5 dígitos.',
        'instructor.postal_empre.digits' => 'El código postal debe tener 5 dígitos.',
        'instructor.curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
        'instructor.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'instructor.rfc_empre.size' => 'El RFC de la empresa debe tener exactamente 13 caracteres.',
        'instructor.telefono1.digits' => 'El número de celular debe tener 10 dígitos.',
        'instructor.telefono2.digits' => 'El número de celular debe tener 10 dígitos.',
        'instructor.registro_patronal_id.exists' => 'El Reg Patronal seleccionado no existe.',

        'instructor.cuentabancaria.digits' => 'El número de cuenta debe tener 16 dígitos.',
        'instructor.rfc.unique' => 'Esta RFC ya esta asignada a otro instructor.',
        'instructor.cuentabancaria.unique' => 'Esta cuenta ya esta asignada a otro instructor.',
        'instructor.curp.unique' => 'Esta CURP ya esta asignada a otro instructor.',

        'nombre.required' => 'Este campo es obligatorio.',
        'apellido_p.required' => 'Este campo es obligatorio.',
        'apellido_m.required' => 'Este campo es obligatorio.',
        'user.email.required' => 'Este campo es obligatorio.',
        'user.email.unique' => 'Este correo ya esta en uso.',
        'password.required' => 'Este campo es obligatorio.',
        'empresa.required' => 'Este campo es obligatorio.',
        'sucursal.required' => 'Este campo es obligatorio.',
        'departamento.required' => 'Este campo es obligatorio.',
        'user.puesto_id.required' => 'Este campo es obligatorio.',
        'user.puesto_id.exists' => 'El puesto seleccionado no existe.',
    ];



    // Método para guardar el registro patronal
    public function saveInstructor()
    {
        $this->validate();
        $this->user['name'] = $this->nombre." ".$this->apellido_p." ".$this->apellido_m;
        $this->user['password'] =  Hash::make($this->password);
        $this->user['empresa_id'] = $this->empresa;
        $this->user['sucursal_id'] = $this->sucursal;
        $this->user['departamento_id'] = $this->departamento;
        $this->user['tipo_user'] = "Instructor";

        $guardaUser = new User($this->user);
        $guardaUser -> save();
        $this->instructor['user_id'] = $guardaUser->id;

        Instructor::create($this->instructor);
        $this->instructor = [];
        //$this->emit('showAnimatedToast', 'Registro patronal guardado correctamente.');
        return redirect()->route('mostrarinstructor');
    }

    public function redirigirInstructor()
    {
        return redirect()->route('mostrarinstructor');
    }

    public function render()
    {
        return view('livewire.portal-rh.instructor.agregar-instructor')->layout('layouts.client');
    }
}
