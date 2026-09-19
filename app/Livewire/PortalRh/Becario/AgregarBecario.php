<?php

namespace App\Livewire\PortalRh\Becario;

use Livewire\Component;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AgregarBecario extends Component
{
    public $becario = [], $sucursales=[], $departamentos=[], $puestos=[], $user=[];

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
        'becario.clave_becario' => 'required|unique:becarios,clave_becario',
        'becario.numero_seguridad_social' => 'required|digits:11|unique:becarios,numero_seguridad_social',
        'becario.fecha_nacimiento' => 'required',
        'becario.lugar_nacimiento' => 'required',
        'becario.estado' => 'required',
        'becario.codigo_postal' => 'required|digits:5',
        'becario.ocupacion' => 'required',
        'becario.sexo' => 'required',
        'becario.curp' => 'required|size:18|unique:becarios,curp',
        'becario.rfc' => 'required|size:13|unique:becarios,rfc',
        'becario.numero_celular' => 'required|digits:10',
        'becario.fecha_ingreso' => 'required',
        'becario.status' => 'required',
        'becario.calle' => 'required',
        'becario.colonia' => 'required',
        'becario.registro_patronal_id' => 'required|exists:registros_patronales,id',

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
        'becario.*.required' => 'Este campo es obligatorio.',
        'becario.clave_becario.unique' => 'Esta clave ya esta asignada a otro becario.',
        'becario.codigo_postal.digits' => 'El código postal debe tener 5 dígitos.',
        'becario.curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
        'becario.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'becario.numero_celular.digits' => 'El número de celular debe tener 10 dígitos.',
        'becario.registro_patronal_id.exists' => 'El Reg Patronal seleccionado no existe.',

        'becario.numero_seguridad_social.digits' => 'El NSS debe tener 11 dígitos.',
        'becario.numero_seguridad_social.unique' => 'Este NSS ya esta asignada a otro becario.',
        'becario.rfc.unique' => 'Esta RFC ya esta asignada a otro becario.',
        'becario.curp.unique' => 'Esta CURP ya esta asignada a otro becario.',

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
    public function saveBecario()
    {
        $this->validate();
        $this->user['name'] = $this->nombre." ".$this->apellido_p." ".$this->apellido_m;
        $this->user['password'] =  Hash::make($this->password);
        $this->user['empresa_id'] = $this->empresa;
        $this->user['sucursal_id'] = $this->sucursal;
        $this->user['departamento_id'] = $this->departamento;
        $this->user['tipo_user'] = "Becario";

        $guardaUser = new User($this->user);
        $guardaUser -> save();
        $this->becario['user_id'] = $guardaUser->id;


        Becario::create($this->becario);
        $this->becario = [];
        //$this->emit('showAnimatedToast', 'Registro patronal guardado correctamente.');
        return redirect()->route('mostrarbecario'); 
    }


    public function redirigirBecario()
    {
        return redirect()->route('mostrarbecario');
    }

    public function render()
    {
        return view('livewire.portal-rh.becario.agregar-becario')->layout('layouts.client');
    }
}
