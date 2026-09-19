<?php

namespace App\Livewire\PortalRh\Rol;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;

class EditarRol extends Component
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
        $this->selectedPermissions = $rol->permissions->pluck('id')->toArray(); // Guardar IDs en lugar de nombres

        $this->permissions = Permission::all();
    }

    public function actualizarRol()
    {
        $this->validate([
            'nombre' => 'required|string|unique:roles,name,' . $this->rol_id,
            'selectedPermissions' => 'array'
        ]);

        $rol = Role::findOrFail($this->rol_id);
        $rol->name = $this->nombre;
        $rol->save();

        // Obtener los nombres de los permisos seleccionados
        $permisosNombres = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

        // Sincronizar permisos con los nombres obtenidos
        $rol->syncPermissions($permisosNombres);

        session()->flash('message', 'Rol actualizado correctamente.');

        return redirect()->route('mostrarrol');
    }
    


    //return redirect()->route('mostrarrol');
    
    public function render()
    {
        return view('livewire.portal-rh.rol.editar-rol')->layout('layouts.client');
    }

}
