<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use Livewire\Component;

class MostrarPapeleria extends Component
{
    protected $listeners = ['confirmDelete'];
    public function redirigir()
    {
        return redirect()->route('mostrarpape');
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
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-empresa.mostrar-papeleria')->layout('layouts.navactivos');
    }
}
