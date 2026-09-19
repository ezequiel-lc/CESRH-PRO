<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;

class MostrarPerfilPuestoEmpresa extends Component
{
    public $showModal = false;
    public $search = '';
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;
    public $sucursalSeleccionada = '';


    public function mount()
    {
        // Obtener todas las sucursales de la empresa del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();
    }

    public function redirigir()
    {
        return redirect()->route('agregarPerfilPuestoEmpresa');
    }

    protected $listeners = [
        'confirmDelete' => 'confirmDelete',
    ];

    public function confirmDelete($id)
    {
        $this->perfilToDelete = $id;
        $this->showModal = true;
    }

    public function deletePerfil()
    {
        if ($this->perfilToDelete) {
            PerfilPuesto::find($this->perfilToDelete)->delete();
            session()->flash('message', 'Perfil de Puesto eliminado exitosamente.');
        }

        $this->perfilToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarPerfilPuesto');
    }

    public function render()
    {
        //$puestos = PerfilPuesto::where('nombre_puesto', 'LIKE', "%{$this->search}%")->get();
        $puestos = PerfilPuesto::where('empresa_id', $this->empresa_id)
        ->when($this->sucursalSeleccionada, function ($query) {
            $query->whereIn('sucursal_id', function ($query) {
                $query->select('sucursal_id')
                      ->from('empresa_sucursal')
                      ->where('empresa_id', $this->empresa_id)
                      ->where('sucursal_id', $this->sucursalSeleccionada);
            });
        })
        ->where('nombre_puesto', 'LIKE', "%{$this->search}%")
        ->get();     

        return view('livewire.portal-capacitacion.perfil-puesto.admin-empresa.mostrar-perfil-puesto-empresa', compact('puestos'))->layout("layouts.portal_capacitacion");
    }
}
