<?php

namespace App\Livewire\Portal360;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AgregarRolesPermisos extends Component
{
    
    public $RolNombre, $permisos = [], $Consulta2;

    public function mount()
    {
        // Obtener todos los permisos disponibles
        $this->Consulta2 = Permission::all();
    }

    protected $rules = [
        'RolNombre' => 'required|unique:roles,name',
        'permisos'  => 'required|array|min:1'
    ];

    protected $validationAttributes = [
        'RolNombre' => "Rol",
        'permisos'  => "Permisos"
    ];

    public function saveRol()
    {
        $this->validate();

        try {
            $role = Role::create([
                'name'       => $this->RolNombre,
                'guard_name' => 'web'
            ]);

            $role->syncPermissions($this->permisos);

            // Limpiar campos después de guardar
            $this->RolNombre = null;
            $this->permisos  = [];

            // Notificación de éxito
            $this->dispatch('toastr-success', message: 'Rol guardado correctamente');
        } catch (\Exception $e) {
            // Notificación de error
            $this->dispatch('toastr-error', message: 'Error al guardar el rol: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portal360.agregar-roles-permisos')->layout('layouts.portal360');
    }
}

