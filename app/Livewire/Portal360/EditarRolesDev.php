<?php

namespace App\Livewire\Portal360;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class EditarRolesDev extends Component
{
    public $rolesdevId, $name;

    public function mount($id){
        try{
            $this->rolesdevId = Crypt::decrypt($id);

            $tem = Permission::findOrFail($this->rolesdevId);

            $this->name = $tem->name;
        }catch(\Exception $e){
            $this->emit('error', 'Error al cargar los Roles: ' . $e->getMessage());
        }
    }

    public function editRolesdev(){
        try {
            $this->validate([
                'name' => 'required|min:3',
            ], [
                'name.min' => 'El nombre debe tener al menos 3 caracteres',
            ]);
    
            Permission::updateOrCreate(['id' => $this->rolesdevId], [
                'name' => $this->name
            ]);
    
            // Notificación de éxito
            $this->dispatch('toastr-success', message: 'Roles Editado Correctamente.');
    
            // Redireccionar a la lista de Roles
            return redirect()->route('portal360.mostrarRoles');
    
        } catch (\Exception $e) {
            // Notificación de error
            $this->dispatch('toastr-error', message: 'Error al editar roles: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.portal360.editar-roles-dev')->layout('layouts.portal360');
    }

    // public function render()
    // {
    //     return view('livewire.portal360.editar-roles-dev');
    // }
}
