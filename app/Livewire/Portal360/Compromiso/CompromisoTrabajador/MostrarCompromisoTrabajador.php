<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoTrabajador;

use Livewire\Component;

class MostrarCompromisoTrabajador extends Component
{

    public function redirigirCompromisosTrabajador()
    {
        return redirect()->route('agregarCompromisoTrabajador');
    }


    public function render()
    {
        return view('livewire.portal360.compromiso.compromiso-trabajador.mostrar-compromiso-trabajador')
            ->layout('layouts.portal360')
            ->with([
                'table' => CompromisoTrabajadorTable::class
            ]);
    }
}
