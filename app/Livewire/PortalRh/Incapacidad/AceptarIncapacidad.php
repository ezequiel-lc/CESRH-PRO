<?php

namespace App\Livewire\PortalRh\Incapacidad;
use App\Models\PortalRH\Incapacidad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class AceptarIncapacidad extends Component
{
    public $incapacidades_pendientes;

    public function mount()
    {
        // Obtener incidencias con status "Pendiente"
        $this->incapacidades_pendientes = Incapacidad::with('users')
        ->where('status', 'Pendiente')
        ->get();
    }

    public function aprobar($incapacidadId)
    {
        $incapacidad = Incapacidad::findOrFail($incapacidadId);

        // Actualizar status de la incidencia a 'Aprobada'
        $incapacidad->status = 'Aprobada';
        $incapacidad->save();

        session()->flash('message', 'Incapacidad aprobada y registrada.');

        // Recargar la página
        return redirect()->to(request()->header('Referer'));
    }

    public function rechazar($incapacidadId)
    {
        $incapacidad = Incapacidad::findOrFail($incapacidadId);

        // Actualizar status de la incidencia a 'Rechazada'
        $incapacidad->status = 'Rechazada';
        $incapacidad->save();

        session()->flash('message', 'Incapacidad rechazada.');

        // Recargar la página
        return redirect()->to(request()->header('Referer'));
        
    }

    public function render()
    {
        return view('livewire.portal-rh.incapacidad.aceptar-incapacidad')->layout('layouts.client');
    }
}
