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
use Illuminate\Support\Facades\Hash;

class AgregarPracticante extends Component
{
    public $practicante = [], $sucursales=[], $departamentos=[], $puestos=[], $user=[];

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
        //dd(); users
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
        'practicante.clave_practicante' => 'required|unique:practicantes,clave_practicante',
        'practicante.numero_seguridad_social' => 'required|digits:11|unique:practicantes,numero_seguridad_social',
        'practicante.fecha_nacimiento' => 'required',
        'practicante.lugar_nacimiento' => 'required',
        'practicante.estado' => 'required',
        'practicante.codigo_postal' => 'required|digits:5',
        'practicante.ocupacion' => 'required',
        'practicante.sexo' => 'required',
        'practicante.curp' => 'required|size:18|unique:practicantes,curp',
        'practicante.rfc' => 'required|size:13|unique:practicantes,rfc',
        'practicante.numero_celular' => 'required|digits:10',
        'practicante.registro_patronal_id' => 'required|exists:registros_patronales,id',

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
        'practicante.*.required' => 'Este campo es obligatorio.',
        'practicante.clave_practicante.unique' => 'Esta clave ya esta asignada a otro practicante.',
        'practicante.codigo_postal.digits' => 'El código postal debe tener 5 dígitos.',
        'practicante.curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
        'practicante.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'practicante.numero_celular.digits' => 'El número de celular debe tener 10 dígitos.',
        'practicante.registro_patronal_id.exists' => 'El Reg Patronal seleccionado no existe.',

        'practicante.numero_seguridad_social.digits' => 'El NSS debe tener 11 dígitos.',
        'practicante.numero_seguridad_social.unique' => 'Este NSS ya esta asignada a otro practicante.',
        'practicante.rfc.unique' => 'Esta RFC ya esta asignada a otro practicante.',
        'practicante.curp.unique' => 'Esta CURP ya esta asignada a otro practicante.',

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
    public function savePracticante()
    {
        $this->validate();
        $this->user['name'] = $this->nombre." ".$this->apellido_p." ".$this->apellido_m;
        $this->user['password'] =  Hash::make($this->password);
        $this->user['empresa_id'] = $this->empresa;
        $this->user['sucursal_id'] = $this->sucursal;
        $this->user['departamento_id'] = $this->departamento;
        $this->user['tipo_user'] = "Practicante";



        $guardaUser = new User($this->user);
        $guardaUser -> save();
        $this->practicante['user_id'] = $guardaUser->id;

        Practicante::create($this->practicante);
        $this->practicante = [];
        //$this->emit('showAnimatedToast', 'Registro patronal guardado correctamente.');
        return redirect()->route('mostrarpracticante'); 
    }

    
    
    public function redirigirPracticante()
    {
        return redirect()->route('mostrarpracticante');
    }

    public function render()
    {
        return view('livewire.portal-rh.practicante.agregar-practicante')->layout('layouts.client');
    }
}
