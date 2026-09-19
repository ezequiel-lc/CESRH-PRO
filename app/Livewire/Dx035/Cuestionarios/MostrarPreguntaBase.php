<?php

namespace App\Livewire\Dx035\Cuestionarios;

use Livewire\Component;

class MostrarPreguntaBase extends Component
{
    public function render()
    {
        return view('livewire.dx035.cuestionarios.mostrar-pregunta-base')
            ->layout('layouts.dx035');
    }
}
