<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminGeneral;

use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class EditarFunEspecificas extends Component
{
    public $funcion_esp_id, $nombre;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $funcion = FuncionEspecifica::findOrFail($id);

        // Asignar datos al componente
        $this->funcion_esp_id = $funcion->id;
        $this->nombre = $funcion->nombre;
        $this->empresa_id = $funcion->empresa_id;

        // Cargar todas las empresas
        $this->empresas = Empresa::all();

        // Cargar sucursales correspondientes a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $funcion->sucursal_id;

    }

    public function updatedEmpresaId()
    {
        // Obtener sucursales relacionadas a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null; // Resetear selección de sucursal
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'empresa_id' => 'required',
            'sucursal_id' => 'required',
        ]);

        FuncionEspecifica::updateOrCreate(['id' => $this->funcion_esp_id], [
            'nombre' => $this->nombre,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarFuncionesEspecificas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-general.editar-fun-especificas')
            ->layout("layouts.portal_capacitacion");
    }
}
