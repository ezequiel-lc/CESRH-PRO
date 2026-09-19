<?php

namespace App\Livewire\Dx035\Rol;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AgregarRol extends Component
{
    public $name;
    public $selectedPermissions = [];
    public $permissions = [];

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    protected $rules = [
        'name' => 'required|string|unique:roles,name',
        'selectedPermissions' => 'required|array'
    ];

    public function AgregarRol()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);

        if (!empty($this->selectedPermissions)) {
            $role->syncPermissions($this->selectedPermissions);
        }

        session()->flash('message', 'Rol creado y permisos asignados correctamente.');
        $this->reset(['name', 'selectedPermissions']);
        return redirect()->route('mostrarrol');
    }

    public function render()
    {
        return view('livewire.dx035.rol.agregar-rol')->layout('layouts.dx035');
    }
}