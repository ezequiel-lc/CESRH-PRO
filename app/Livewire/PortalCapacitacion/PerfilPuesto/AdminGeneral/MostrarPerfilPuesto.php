<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;

class MostrarPerfilPuesto extends Component
{
    public $showModal = false;
    public $perfilToDelete;
    public $search = '';

    public function redirigir()
    {
        return redirect()->route('agregarPerfilPuesto');
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
        $puestos = PerfilPuesto::where('nombre_puesto', 'LIKE', "%{$this->search}%")->get();

        return view('livewire.portal-capacitacion.perfil-puesto.admin-general.mostrar-perfil-puesto', compact('puestos'))
            ->layout("layouts.portal_capacitacion");
    }
}
