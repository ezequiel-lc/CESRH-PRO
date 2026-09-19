<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminTrabajador;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class MostrarCapacitacionesGruTrabajador extends Component
{
    public $userSeleccionado;
    public $user;
    public $capacitaciones;

    public function mount($id)
    {
        $this->userSeleccionado = Crypt::decrypt($id);
        $this->user = User::find($this->userSeleccionado);
        $this->capacitaciones = $this->user->capacitacionesGrupales; // Obtiene las capacitaciones
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-trabajador.mostrar-capacitaciones-grupales', [
            'capacitaciones' => $this->capacitaciones
        ])->layout("layouts.portal_capacitacion");
    }
}
