<?php

namespace App\Livewire\PortalRh\Rol;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;

class VerPermisos extends Component
{
    public $rol_id;
    public $nombre;
    public $selectedPermissions = [];
    public $permissions = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $rol = Role::findOrFail($id);

        $this->rol_id = $id;
        $this->nombre = $rol->name;
        $this->selectedPermissions = $rol->permissions->pluck('id')->toArray();
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.portal-rh.rol.ver-permisos')->layout('layouts.client');
    }
}
