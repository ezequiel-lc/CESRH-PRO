<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Livewire\WithFileUploads;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;

class AgregarRelacionesInternas extends Component
{
    public $interna=[];
    public $consulta;
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'interna.puesto' => 'required',
        'interna.razon_motivo' => 'required',
        'interna.frecuencia' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'interna.puesto.required' => 'El campo puesto es obligatorio',
        'interna.razon_motivo.required' => 'El campo razón motivo es obligatorio',
        'interna.frecuencia.required' => 'El campo frecuencia es obligatorio',  
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
        $this->consulta = RelacionInterna::all();
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

    public function agregarInterna()
    {
        $this->validate();

        RelacionInterna::create([
            'puesto' => $this->interna['puesto'],
            'razon_motivo' => $this->interna['razon_motivo'],
            'frecuencia' => $this->interna['frecuencia'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);
        $this->interna=[];
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->sucursales = [];
        
        session()->flash('message', 'Relación externa creada exitosamente.');
        
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-general.agregar-relaciones-internas')->layout("layouts.portal_capacitacion");
    }
}
