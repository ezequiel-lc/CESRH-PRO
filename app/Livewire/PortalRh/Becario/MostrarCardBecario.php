<?php

namespace App\Livewire\PortalRh\Becario;

use Livewire\Component;
use App\Models\User;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Puesto;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;

class MostrarCardBecario extends Component
{
    use WithPagination;

    //para obtener todos los usuarios y sus datos
    public $becarios, $usuarios, $registros_patronales, 
    $emp, $suc, $depa, $puest;

    public $search = '';

    
    //para el filtrado
    public $sucursales=[], $departamentos=[], $puestos=[], $users=[];
    public $empresas, $empresa, $sucursal, $departamento, $puesto;
    
    public function mount()
    {
        // Obtener todos los registros de las tablas relacionadas
        $this->becarios = Becario::all();
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
        $this->becarios = Becario::query()
            ->when($this->empresa, function ($query) {
                $query->whereHas('usuario', function ($q) {
                    $q->where('empresa_id', $this->empresa);
                });
            })
            ->when($this->sucursal, function ($query) {
                $query->whereHas('usuario', function ($q) {
                    $q->where('sucursal_id', $this->sucursal);
                });
            })
            ->when($this->departamento, function ($query) {
                $query->whereHas('usuario', function ($q) {
                    $q->where('departamento_id', $this->departamento);
                });

            })
            ->when($this->search, function ($query) {
                $query->whereHas('usuario', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('clave_becario', 'like', '%' . $this->search . '%');
            })
            ->get();
            
        
    }

    public function redirigir($id)
    {
        $id_encriptado = Crypt::encrypt($id);
        return redirect()->route('cardbecario', ['id' => $id_encriptado]);
    }



    public function render()
    {
        return view('livewire.portal-rh.becario.mostrar-card-becario')->layout('layouts.client');
    }
}
