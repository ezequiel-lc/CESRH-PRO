<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;
use Illuminate\Support\Facades\Auth;

class MostrarPerfilPuestoSucursal extends Component
{
    public $showModal = false;
    public $perfilToDelete;
    public $search = '';

    public function mount()
    {
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
    }

    public function redirigir()
    {
        return redirect()->route('agregarPerfilPuestoSucursal');
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

        return redirect()->route('mostrarPerfilPuestoSucursal');
    }

    public function render()
    {
        //$puestos = PerfilPuesto::where('nombre_puesto', 'LIKE', "%{$this->search}%")->get();
        $puestos = PerfilPuesto::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id) // Filtrar por la sucursal del usuario
        ->where('nombre_puesto', 'LIKE', "%{$this->search}%")
        ->get();

        return view('livewire.portal-capacitacion.perfil-puesto.admin-sucursal.mostrar-perfil-puesto-sucursal', compact('puestos'))
            ->layout("layouts.portal_capacitacion");
    }
}