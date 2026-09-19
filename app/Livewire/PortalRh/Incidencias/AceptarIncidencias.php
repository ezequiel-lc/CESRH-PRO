<?php

namespace App\Livewire\PortalRh\Incidencias;
use App\Models\PortalRH\Incidencia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Livewire\Component;

class AceptarIncidencias extends Component
{
    public $incidencias_pendientes;

    public function mount()
    {
        // Obtener incidencias con status "Pendiente"
        $this->incidencias_pendientes = Incidencia::with('users')
        ->where('status', 'Pendiente')
        ->get();
    }

    public function aprobar($incidenciaId)
    {
        $incidencia = Incidencia::findOrFail($incidenciaId);

        // Actualizar status de la incidencia a 'Aprobada'
        $incidencia->status = 'Aprobada';
        $incidencia->save();

        session()->flash('message', 'Incidencia aprobada y registrada.');

        // Recargar la página
        return redirect()->to(request()->header('Referer'));
    }

    public function rechazar($incidenciaId)
    {
        $incidencia = Incidencia::findOrFail($incidenciaId);

        // Actualizar status de la incidencia a 'Rechazada'
        $incidencia->status = 'Rechazada';
        $incidencia->save();

        session()->flash('message', 'Incidencia rechazada.');

        // Recargar la página
        return redirect()->to(request()->header('Referer'));
        
    }

    public function render()
    {
        return view('livewire.portal-rh.incidencias.aceptar-incidencias')->layout('layouts.client');
    }
}
