<?php

namespace App\Livewire\Portal360\Envaluaciones\EnvalaucionesTrabajador;

use Livewire\Component;

class AsignacionesPendientes extends Component
{
    public function render()
    {
        return view('livewire.portal360.envaluaciones.envalauciones-trabajador.asignaciones-pendientes')->layout('layouts.portal360');
    }
}
