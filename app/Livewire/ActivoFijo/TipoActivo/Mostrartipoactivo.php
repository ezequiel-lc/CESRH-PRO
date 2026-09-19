<?php

namespace App\Livewire\ActivoFijo\TipoActivo;

use App\Models\ActivoFijo\Tipoactivo;
use Livewire\Component;

class Mostrartipoactivo extends Component
{

    public function render()
    {
        return view('livewire.activo-fijo.tipo-activo.mostrartipoactivo')->layout('layouts.navactivos');
    }
}
