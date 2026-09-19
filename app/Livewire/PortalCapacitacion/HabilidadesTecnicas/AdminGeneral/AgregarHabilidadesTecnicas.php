<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica; 
use Livewire\WithFileUploads;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;

class AgregarHabilidadesTecnicas extends Component
{
    public $tecnica=[];
    public $consulta;
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id; 

    protected $rules = [
        'tecnica.descripcion' => 'required',
        'tecnica.nivel' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'tecnica.descripcion.required' => 'La descripción es obligatoria.',
        'tecnica.nivel.required' => 'El nivel es obligatorio.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
        $this->consulta = FormacionHabilidadTecnica::all();
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

    public function agregarTecnica()
    {
        $this->validate();
        
        FormacionHabilidadTecnica::create([
            'descripcion' => $this->tecnica['descripcion'],
            'nivel' => $this->tecnica['nivel'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        // Limpiar los datos del formulario
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->tecnica = [];
        $this->sucursales = [];

        session()->flash('message', 'Habilidad Tecnica creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-general.agregar-habilidades-tecnicas')->layout("layouts.portal_capacitacion");
    }
}
