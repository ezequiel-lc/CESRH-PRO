<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasSucursal;

use Livewire\Component;

class EliminarPreguntaSucursal extends Component
{
    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-sucursal.eliminar-pregunta-sucursal')->layout('layouts.portal360');
    }
}
