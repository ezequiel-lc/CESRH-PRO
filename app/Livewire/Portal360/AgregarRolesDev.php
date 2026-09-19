<?php

namespace App\Livewire\Portal360;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AgregarRolesDev extends Component
{

    public $rolesdev = [];

    protected $rules = [
        'rolesdev.name' => 'required|min:3',
    ];

    protected $messages = [
        'rolesdev.name.min' => 'El nombre debe tener al menos 3 caracteres',
    ];

    public function saveRol(){
        $this->validate();
    
        try {
            $nuevoRoles  = new Permission($this->rolesdev);
            $nuevoRoles->save();
    
            $this->rolesdev = [];
    
            // Notificación de éxito
            $this->dispatch('toastr-success', message: 'Rol Guardada Correctamente.');
    
            return redirect()->route('portal360.mostrarRoles');
        } catch (\Exception $e) {
            // Notificación de error
            $this->dispatch('toastr-error', message: 'Error al guardar el Rol: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.agregar-roles-dev')->layout('layouts.portal360');
    }

    // public function render()
    // {
    //     return view('livewire.portal360.agregar-roles-dev');
    // }
}
