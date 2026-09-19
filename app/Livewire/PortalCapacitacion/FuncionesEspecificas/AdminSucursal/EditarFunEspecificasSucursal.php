<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal;

use App\Models\PortalCapacitacion\FuncionEspecifica;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRh\Sucursal;

class EditarFunEspecificasSucursal extends Component
{
    public $funcion_esp_id, $nombre;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $funcion = FuncionEspecifica::findOrFail($id);

        $this->funcion_esp_id = $funcion->id;
        $this->nombre = $funcion->nombre;
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener sucursales relacionadas a la empresa desde la tabla pivote empresa_sucursal
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();

        $this->sucursal_id = $funcion->sucursal_id;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
        ]);

        FuncionEspecifica::updateOrCreate(['id' => $this->funcion_esp_id], [
            'nombre' => $this->nombre,
        ]);

        return redirect()->route('mostrarFuncionesEspecificasSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-sucursal.editar-fun-especificas-sucursal')
            ->layout("layouts.portal_capacitacion");
    }
}
