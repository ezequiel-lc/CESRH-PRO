<?php

namespace App\Livewire;

use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class AsignarActivo extends ModalComponent
{
    public $activoId;
    public $usuarioId;

    public function mount($activoId)
    {
        $this->activoId = $activoId;
    }

    public function asignar()
    {
        $activo = ActivoTecnologia::find($this->activoId);
        if ($activo) {
            $activo->user_id = $this->usuarioId;
            $activo->save();

            $this->closeModal(); // ✅ Ahora este método funcionará correctamente
            $this->dispatch('refreshPowerGrid');
            session()->flash('message', 'Activo asignado correctamente.');
        }
    }
    public function render()
    {
        return view('livewire.asignar-activo', [
            'usuarios' => User::all(),
        ]);
    }
}
