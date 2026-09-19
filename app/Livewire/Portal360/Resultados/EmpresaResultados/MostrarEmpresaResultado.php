<?php

namespace App\Livewire\Portal360\Resultados\EmpresaResultados;

use App\Models\PortalRH\EmpresaSucursal;
use Livewire\Component;

class MostrarEmpresaResultado extends Component
{

    public function render()
    {
        return view('livewire.portal360.resultados.empresa-resultados.mostrar-empresa-resultado')->layout('layouts.portal360');
    }
}
