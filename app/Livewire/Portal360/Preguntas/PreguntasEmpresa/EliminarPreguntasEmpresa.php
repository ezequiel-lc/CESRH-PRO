<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasEmpresa;

use Livewire\Component;

class EliminarPreguntasEmpresa extends Component
{
    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-empresa.eliminar-preguntas-empresa')->layout('layouts.portal360');
    }
}
