<?php

namespace App\Livewire\PortalCapacitacion\Usuarios\AdminEmpresa;

use Livewire\Component;
use App\Models\User;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;

class MostrarUsuarioEmpresa extends Component
{
    public $search = '';
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id = null; // Ahora inicia en NULL para que no muestre usuarios

    public function mount()
    {
        // Obtener la empresa del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener todas las sucursales asociadas a la empresa
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();
    }

    public function render()
    {
        // No mostrar usuarios hasta que se seleccione una sucursal
        $users = collect(); 

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

        return view('livewire.portal-capacitacion.usuarios.admin-empresa.mostrar-usuario-empresa', compact('users'))
            ->layout("layouts.portal_capacitacion");
    }
}
