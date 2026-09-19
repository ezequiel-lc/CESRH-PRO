<?php

namespace App\Livewire\PortalRh\Instructor;

use Livewire\Component;
use App\Models\PortalRH\Instructor;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Puesto;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class MostrarCardInstructor extends Component
{
    //para obtener todos los usuarios y sus datos
    public $instructores, $usuarios, $registros_patronales, 
    $emp, $suc, $depa, $puest;

    //para el filtrado
    public $sucursales=[], $departamentos=[], $puestos=[], $users=[];
    public $empresas, $empresa, $sucursal, $departamento, $puesto;

    public $search = '';

    public function mount()
    {
        // Obtener todos los registros de las tablas relacionadas
        $this->instructores = Instructor::all();
        $this->usuarios = User::all()->keyBy('id'); // Indexamos por ID para acceso rápido
        $this->emp = Empresa::all()->keyBy('id');
        $this->suc = Sucursal::all()->keyBy('id');
        $this->depa = Departamento::all()->keyBy('id');
        $this->puest = Puesto::all()->keyBy('id');
        $this->registros_patronales = RegistroPatronal::all()->keyBy('id');
        

        $this->empresas = Empresa::all();
        $this->filtrar();
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

    public function updatedPuesto()
    {
        // Obtener los puestos del departamento seleccionado
        $this->users = Departamento::with('users')->where('id', $this->puesto)->get();
    }

    public function filtrar()
    {
        $this->instructores = Instructor::query()
            ->when($this->empresa, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('empresa_id', $this->empresa);
                });
            })
            ->when($this->sucursal, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('sucursal_id', $this->sucursal);
                });
            })
            ->when($this->departamento, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('departamento_id', $this->departamento);
                });

            })
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('rfc', 'like', '%' . $this->search . '%');
            })
            ->get();
                
    }

    public function redirigir($id)
    {
        $id_encriptado = Crypt::encrypt($id);
        return redirect()->route('cardinstructor', ['id' => $id_encriptado]);
    }

    public function render()
    {
        return view('livewire.portal-rh.instructor.mostrar-card-instructor')->layout('layouts.client');
    }
}
