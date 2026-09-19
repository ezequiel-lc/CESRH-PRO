<?php

namespace App\Livewire\Dx035\Rol;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AsignarRol extends Component
{
    public $userId;
    public $user;
    public $roles = [];
    public $selectedRoles = [];

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
        $this->roles = Role::all();
        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();
    }

    public function asignarRoles()
    {
        // Obtener los nombres de los roles seleccionados
        $rolesSeleccionados = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
    
        // Sincronizar los roles usando los nombres
        $this->user->syncRoles($rolesSeleccionados);
    
        session()->flash('message', 'Roles asignados correctamente.');
    }

    public function render()
    {
        return view('livewire.dx035.rol.asignar-rol')->layout('layouts.dx035');
    }
}