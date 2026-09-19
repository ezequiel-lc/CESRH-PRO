<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Livewire\WithFileUploads;

class AgregarHabilidadesHumanas extends Component
{
    public $humana=[];
    public $consulta; 
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'humana.descripcion' => 'required',
        'humana.nivel' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'humana.descripcion.required' => 'La descripción es obligatoria.',
        'humana.nivel.required' => 'El nivel es obligatorio.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
        $this->consulta = FormacionHabilidadHumana::all();
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

    public function agregarHumana()
    {
        $this->validate();

        FormacionHabilidadHumana::create([
            'descripcion' => $this->humana['descripcion'],
            'nivel' => $this->humana['nivel'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        // Limpiar los datos del formulario
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->humana = [];
        $this->sucursales = [];
        
        session()->flash('message', 'Habilidda Humana creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-humanas.admin-general.agregar-habilidades-humanas')->layout("layouts.portal_capacitacion");
    }
}
