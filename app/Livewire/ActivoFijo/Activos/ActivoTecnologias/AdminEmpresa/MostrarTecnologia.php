<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa;

use Livewire\Component;
use App\Models\ActivoFijo\Activos\ActivoTecnologia;

class MostrarTecnologia extends Component
{
    protected $listeners = ['confirmDelete'];

    public function redirigir()
    {
        return redirect()->route('mostrartec');
    }

    public function confirmDelete($id)
    {
        $activotec = ActivoTecnologia::find($id);
        if ($activotec) {
            // Eliminar el activo
            $activotec->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-tecnologias.admin-empresa.mostrar-tecnologia')->layout('layouts.navactivos');
    }
}
