<?php

namespace App\Livewire\Dx035\Rol;

use Livewire\Component;

class MostrarRol extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $userToDelete; // ID de la sucursal a eliminar


    // Especificar el layout
    public function render()
    {
        return view('livewire.dx035.rol.mostrar-rol')
            ->layout('layouts.dx035');
    }

}
