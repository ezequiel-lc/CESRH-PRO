<?php

namespace App\Livewire\PortalCapacitacion\Usuarios\AdminTrabajador;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MostrarUsuarioTrabajador extends Component
{
    public $search = '';
    public $user; // Variable para almacenar el usuario autenticado

    public function mount()
    {
        // Obtener el usuario autenticado
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.usuarios.admin-trabajador.mostrar-usuario-trabajador', [
            'user' => $this->user // Pasar solo el usuario autenticado
        ])->layout("layouts.portal_capacitacion");
    }
}
