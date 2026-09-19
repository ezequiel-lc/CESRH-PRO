<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Livewire\WithFileUploads;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class AgregarRelacionesExternas extends Component
{
    public $externa=[];
    public $consulta;
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'externa.nombre' => 'required',
        'externa.razon_motivo' => 'required',
        'externa.frecuencia' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'externa.nombre.required' => 'El nombre es obligatorio.',
        'externa.razon_motivo.required' => 'La razón o motivo es obligatorio.',
        'externa.frecuencia.required' => 'El frecuencia es obligatorio.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
        $this->consulta = RelacionExterna::all();
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

    public function agregarExterna()
    {
        $this->validate();

        RelacionExterna::create([
            'nombre' => $this->externa['nombre'],
            'razon_motivo' => $this->externa['razon_motivo'],
            'frecuencia' => $this->externa['frecuencia'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->externa = [];
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->sucursales = [];

        session()->flash('message', 'Relacion externa creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-general.agregar-relaciones-externas')->layout("layouts.portal_capacitacion");
    }
}
