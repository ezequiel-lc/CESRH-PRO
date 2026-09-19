<?php

namespace App\Livewire\ActivoFijo;

use Livewire\Component;

class InicioActivo extends Component
{
    public function render()
    {
        return view('livewire.activo-fijo.inicio-activo')->layout('layouts.navactivos');
    }
}
