<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminEmpresa;

use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalRh\Sucursal;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class EditarFunEspecificasEmpresa extends Component
{
    public $funcion_esp_id, $nombre;
    public $empresa_id, $sucursal_id;
    public $sucursales = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $funcion = FuncionEspecifica::findOrFail($id);

        // Asignar datos al componente
        $this->funcion_esp_id = $funcion->id;
        $this->nombre = $funcion->nombre;
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener sucursales relacionadas a la empresa desde la tabla pivote empresa_sucursal
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $funcion->sucursal_id;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'sucursal_id' => 'required',
        ]);

        FuncionEspecifica::updateOrCreate(['id' => $this->funcion_esp_id], [
            'nombre' => $this->nombre,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarFuncionesEspecificasEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-empresa.editar-fun-especificas-empresa')
            ->layout("layouts.portal_capacitacion");
    }
}
