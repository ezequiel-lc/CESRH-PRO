<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoOficina;
use Livewire\Component;

class Mostraractofi extends Component
{
    protected $listeners = ['confirmDelete'];

    public function redirigir()
    {
        return redirect()->route('mostraractof');
    }

    public function confirmDelete($id)
    {
        $activoof = ActivoOficina::find($id);
        if ($activoof) {
            // Eliminar el activo
            $activoof->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-oficina.admin-sucursal.mostraractofi')->layout('layouts.navactivos');
    }
}   
