<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;

class AgregarFunEspecificas extends Component
{
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id; 
    public $funcion = [];

    protected $rules = [
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
        'funcion.nombre' => 'required',
    ];

    protected $messages = [
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'funcion.nombre.required' => 'La función específica es obligatoria.',
    ];

    public function mount()
    {
        // Obtener todas las empresas
        $this->empresas = Empresa::all();
        // Iniciar las sucursales vacías hasta que se seleccione una empresa
        $this->sucursales = [];
    }

    public function updatedEmpresaId()
    {
        // Obtener las sucursales de la empresa seleccionada usando la tabla pivote
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        // Resetear la sucursal seleccionada al cambiar de empresa
        $this->sucursal_id = null;
    }

    public function agregarFuncion()
    {
        $this->validate();

        FuncionEspecifica::create([
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
            'nombre' => $this->funcion['nombre']
        ]);

        // Resetear valores después de guardar
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->funcion = [];
        $this->sucursales = [];

        session()->flash('message', 'Función específica agregada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-general.agregar-fun-especificas')
            ->layout("layouts.portal_capacitacion");
    }
}
