<?php

namespace App\Livewire\PortalRh\Retardos;

use Livewire\Component;
use App\Models\PortalRH\Retardo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerRetardos extends Component
{
    public $retardos;

    public function mount()
    {
        $user = Auth::user();

        // Obtener retardos del usuario autenticado (para las tarjetas)
        $this->retardos = Retardo::with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.portal-rh.retardos.ver-retardos')->layout('layouts.client');
    }
}
