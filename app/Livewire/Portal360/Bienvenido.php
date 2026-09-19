<?php

namespace App\Livewire\Portal360;

use Livewire\Component;

class Bienvenido extends Component
{
    public function render()
    {
        return view('livewire.portal360.bienvenido')->layout('layouts.portal360');
    }
}
