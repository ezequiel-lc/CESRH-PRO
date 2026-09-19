<?php

namespace App\Livewire\Crm\CrmEmpresa\Mostrar;

use Livewire\Component;

class MostrarEmpre extends Component
{
    public function render()
    {
        return view('livewire.crm.crm-empresa.mostrar.mostrar-empre')->layout('layouts.crm');
    }
}