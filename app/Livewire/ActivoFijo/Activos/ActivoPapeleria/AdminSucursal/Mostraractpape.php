<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use Livewire\Component;

class Mostraractpape extends Component
{
    protected $listeners = ['confirmDelete'];
    public function redirigir()
    {
        return redirect()->route('mostraractpape');
    }

    public function confirmDelete($id)
    {
        $activotec = ActivoPapeleria::find($id);
        if ($activotec) {
            // Eliminar el activo
            $activotec->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-sucursal.mostraractpape')->layout('layouts.navactivos');
    }
}
