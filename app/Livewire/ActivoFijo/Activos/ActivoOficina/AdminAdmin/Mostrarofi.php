<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoOficina;
use Livewire\Component;

class Mostrarofi extends Component
{
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-oficina.admin-admin.mostrarofi')->layout('layouts.navactivos');
    }
}
