<?php

namespace App\Livewire\Dx035\Rol;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditarRol extends Component
{
    public $roleId;
    public $name;
    public $selectedPermissions = [];
    public $permissions = [];

    public function mount($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->permissions = Permission::all();
    }

    protected $rules = [
        'name' => 'required|string|unique:roles,name,' . '$this->roleId',
        'selectedPermissions' => 'required|array',
    ];

    public function actualizarRol()
    {
        $this->validate();

        $role = Role::findOrFail($this->roleId);
        $role->name = $this->name;
        $role->save();

        $role->syncPermissions($this->selectedPermissions);

        session()->flash('message', 'Rol actualizado correctamente.');
        return redirect()->route('mostrarrol');
    }

    public function render()
    {
        return view('livewire.dx035.rol.editar-rol')->layout('layouts.dx035');
    }
}