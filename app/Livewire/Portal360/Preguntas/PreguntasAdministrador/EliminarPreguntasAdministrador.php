<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasAdministrador;

use Livewire\Component;

class EliminarPreguntasAdministrador extends Component
{
    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-administrador.eliminar-preguntas-administrador')->layout('layouts.portal360');
    }
}
