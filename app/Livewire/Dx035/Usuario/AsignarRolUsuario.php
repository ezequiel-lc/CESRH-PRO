<?php

namespace App\Livewire\Dx035\Usuario;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

class AsignarRolUsuario extends Component
{
    public $user_id, $name, $rol, $roles;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);

        $this->user_id = $id;
        $this->name = $user->name;

        // Obtener el primer rol del usuario (si tiene uno)
        $this->rol = $user->roles->first()?->id ?? '';

        // Obtener roles disponibles según el usuario actual
        $currentUser = auth()->user();
        if ($currentUser->hasRole('GoldenAdmin')) {
            $this->roles = Role::all(); // GoldenAdmin puede asignar cualquier rol
        } elseif ($currentUser->hasRole('EmpresaAdmin')) {
            $this->roles = Role::whereIn('name', ['EmpresaAdmin', 'SucursalAdmin'])->get(); // EmpresaAdmin solo puede asignar roles específicos
        } else {
            $this->roles = []; // No puede asignar roles
        }
    }

    public function AgregarRol()
    {
        // Validar los datos
        $this->validate([
            'rol' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($this->user_id);

        // Asignar el rol al usuario
        $role = Role::findOrFail($this->rol);
        $user->syncRoles([$role]); // Reemplaza cualquier rol anterior con el nuevo

        session()->flash('message', 'Rol asignado correctamente.');

        return redirect()->route('usuarios');
    }

    public function render()
    {
        return view('livewire.dx035.usuario.asignar-rol-usuario')->layout('layouts.dx035');
    }
}
