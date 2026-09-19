<?php

namespace App\Livewire\PortalRh\Trabajador;

use Livewire\Component;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AgregarTrabajador extends Component
{
    public $trabajador = [], $sucursales=[], $departamentos=[], $puestos=[], $user=[];

    public $usuarios, $registros_patronales, 
    $empresas, $empresa, $nombre, $apellido_p, $apellido_m, $password,
    $sucursal, $departamento, $rol;


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
        // Obtener los puestos del departamento seleccionado
        //dd();
        $this->departamentos = Sucursal::with('departamentos')->where('id', $this->sucursal)->get();
    }

    public function updatedDepartamento()
    {
        // Obtener los puestos del departamento seleccionado
        $this->puestos = Departamento::with('puestos')->where('id', $this->departamento)->get();
    }

    protected $rules = [
        'trabajador.clave_trabajador' => 'required|unique:trabajadores,clave_trabajador',
        'trabajador.numero_seguridad_social' => 'required|digits:11|unique:trabajadores,numero_seguridad_social',
        'trabajador.fecha_nacimiento' => 'required',
        'trabajador.lugar_nacimiento' => 'required',
        'trabajador.estado' => 'required',
        'trabajador.codigo_postal' => 'required|digits:5',
        'trabajador.sexo' => 'required',
        'trabajador.curp' => 'required|size:18|unique:trabajadores,curp',
        'trabajador.rfc' => 'required|size:13|unique:trabajadores,rfc',
        'trabajador.numero_celular' => 'required|digits:10',
        'trabajador.fecha_ingreso' => 'required',
        'trabajador.edad' => 'required',
        'trabajador.estado_civil' => 'required',
        'trabajador.estudios' => 'required',
        'trabajador.ocupacion' => 'required',
        'trabajador.tipo_puest' => 'required',
        'trabajador.contratacion' => 'required',
        'trabajador.tipo_personal' => 'required',
        'trabajador.jornada_trabajo' => 'required',
        'trabajador.rotacion' => 'required',
        'trabajador.experiencia' => 'required',
        'trabajador.tiempo_puesto' => 'required',
        'trabajador.calle' => 'required',
        'trabajador.colonia' => 'required',
        'trabajador.numero' => 'required',
        'trabajador.status' => 'required',
        'trabajador.registro_patronal_id' => 'required|exists:registros_patronales,id',

        'nombre' => 'required',
        'apellido_p' => 'required',
        'apellido_m' => 'required',
        'user.email' => 'required|unique:users,email',
        'password' => 'required',
        'empresa' => 'required',
        'sucursal' => 'required',
        'departamento' => 'required',
        'user.puesto_id' => 'required|exists:puestos,id',
        //'rol' => 'required',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'trabajador.*.required' => 'Este campo es obligatorio.',
        'trabajador.clave_trabajador.unique' => 'Esta clave ya existe.',
        'trabajador.codigo_postal.digits' => 'El código postal debe tener 5 dígitos.',
        'trabajador.curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
        'trabajador.curp.unique' => 'Esta CURP ya esta asignada a otro trabajador.',
        'trabajador.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'trabajador.rfc.unique' => 'Este RFC ya esta asignada a otro trabajador.',
        'trabajador.numero_celular.digits' => 'El número de celular debe tener 10 dígitos.',
        'trabajador.numero_seguridad_social.digits' => 'El NSS debe tener 11 dígitos.',
        'trabajador.numero_seguridad_social.unique' => 'Esta NSS ya esta asignada a otro trabajador.',
        'trabajador.registro_patronal_id.exists' => 'El Reg Patronal seleccionado no existe.',

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
        //'rol' => 'Este campo es obligatorio.',
    ];



    // Método para guardar el registro patronal
    public function saveTrabajador()
    {
        $this->validate();
        $this->user['name'] = $this->nombre." ".$this->apellido_p." ".$this->apellido_m;
        $this->user['password'] =  Hash::make($this->password);
        $this->user['empresa_id'] = $this->empresa;
        $this->user['sucursal_id'] = $this->sucursal;
        $this->user['departamento_id'] = $this->departamento;
        $this->user['tipo_user'] = "Trabajador";
        //$this->user['rol'] = $this->rol;

        $guardaUser = new User($this->user);
        $guardaUser -> save();
        $this->trabajador['user_id'] = $guardaUser->id;


        Trabajador::create($this->trabajador);
        $this->trabajador = [];
        //$this->emit('showAnimatedToast', 'Registro patronal guardado correctamente.');
        return redirect()->route('mostrartrabajador');
    }

    public function redirigirTrabajador()
    {
        return redirect()->route('mostrartrabajador');
    }

    public function render()
    {
        return view('livewire.portal-rh.trabajador.agregar-trabajador')->layout('layouts.client');
    }
}
