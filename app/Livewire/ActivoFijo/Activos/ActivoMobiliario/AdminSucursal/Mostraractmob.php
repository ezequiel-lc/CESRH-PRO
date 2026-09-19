<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use Livewire\Component;

class Mostraractmob extends Component
{
    protected $listeners = ['confirmDelete'];
    public function redirigir()
    {
        return redirect()->route('mostraractmob');
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
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-sucursal.mostraractmob')->layout('layouts.navactivos');
    }
}
