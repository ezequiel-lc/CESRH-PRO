<?php

namespace App\Livewire\ActivoFijo\Notas;

use Livewire\Component;

class Mostrarnotas extends Component
{
    public function render()
    {
        return view('livewire.activo-fijo.notas.mostrarnotas')->layout('layouts.navactivos');
    }
}
