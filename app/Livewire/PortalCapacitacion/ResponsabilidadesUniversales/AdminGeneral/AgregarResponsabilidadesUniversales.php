<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class AgregarResponsabilidadesUniversales extends Component
{
    public $universal=[];
    public $consulta;
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'universal.sistema' => 'required',
        'universal.responsalidad' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'universal.sistema' => 'El campo sistema es obligatorio',
        'universal.responsalidad' => 'El campo responsabilidad es obligatorio',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
        $this->consulta = ResponsabilidadUniversal::all();
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

    public function agregarUniversal()
    {
        $this->validate();
        ResponsabilidadUniversal::create([
            'empresa_id' => $this->empresa_id,
           'sucursal_id' => $this->sucursal_id,
           'sistema' => $this->universal['sistema'],
           'responsalidad' => $this->universal['responsalidad'],
        ]);

        $this->universal=[];
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->sucursales = [];

        session()->flash('message', 'Responsabilidad universal creada exitosamente.');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-general.agregar-responsabilidades-universales')->layout("layouts.portal_capacitacion");
    }
}
