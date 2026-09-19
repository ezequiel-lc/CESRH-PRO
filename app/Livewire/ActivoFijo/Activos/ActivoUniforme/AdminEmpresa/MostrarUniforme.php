<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoUniforme;
use Livewire\Component;

class MostrarUniforme extends Component
{
    protected $listeners = ['confirmDelete'];

    public function redirigir()
    {
        return redirect()->route('mostraruni');
    }

    public function confirmDelete($id)
    {
        $activotec = ActivoUniforme::find($id);
        if ($activotec) {
            // Eliminar el activo
            $activotec->delete();
            // Agregar una notificación de éxito
            session()->flash('message', 'El activo ha sido eliminado.');
        }
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-uniforme.admin-empresa.mostrar-uniforme')->layout('layouts.navactivos');
    }
}
