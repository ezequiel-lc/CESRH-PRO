<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use Livewire\Component;

class MostrarMobiliario extends Component
{
    protected $listeners = ['confirmDelete'];
    public function redirigir()
    {
        return redirect()->route('mostrarmob');
    }

    public function confirmDelete($id)
    {
        $activotec = ActivoMobiliario::find($id);
        if ($activotec) {
            // Eliminar el activo
            $activotec->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-empresa.mostrar-mobiliario')->layout('layouts.navactivos');
    }
}
