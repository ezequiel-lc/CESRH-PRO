<?php

namespace App\Livewire\PortalCapacitacion\Usuarios\AdminSucursal;

use Livewire\Component;
use App\Models\User;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;

class MostrarUsuarioSucursal extends Component
{
    public $search = '';
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id = null; // Ahora inicia en NULL para que no muestre usuarios

    public function mount()
    {
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
    }

    public function render()
    {

        if ($this->sucursal_id) {
            $users = User::where('empresa_id', $this->empresa_id)
                ->whereIn('sucursal_id', function ($query) {
                    $query->select('sucursal_id')
                        ->from('empresa_sucursal')
                        ->where('empresa_id', $this->empresa_id)
                        ->where('sucursal_id', $this->sucursal_id);
                })
                ->where('name', 'like', '%' . $this->search . '%')
                ->get();
        }

        return view('livewire.portal-capacitacion.usuarios.admin-sucursal.mostrar-usuario-sucursal', compact('users'))
            ->layout("layouts.portal_capacitacion");
    }
}
