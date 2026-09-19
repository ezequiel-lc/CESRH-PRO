<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use Livewire\Component;

class Mostraractsou extends Component
{
    protected $listeners = ['confirmDelete'];
    public function redirigir()
    {
        return redirect()->route('mostraractsou');
    }

    public function confirmDelete($id)
    {
        $activoof = ActivoSouvenir::find($id);
        if ($activoof) {
            // Eliminar el activo
            $activoof->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-souvenir.admin-sucursal.mostraractsou')->layout('layouts.navactivos');
    }
}
