<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica; 
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRH\Sucursal;

class AgregarHabilidadesTecnicasEmpresa extends Component
{
    public $tecnica=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id; 

    protected $rules = [
        'tecnica.descripcion' => 'required',
        'tecnica.nivel' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'tecnica.descripcion.required' => 'La descripción es obligatoria.',
        'tecnica.nivel.required' => 'El nivel es obligatorio.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount()
    {
       // Obtener el ID de la empresa del usuario autenticado
       $this->empresa_id = Auth::user()->empresa_id;
        
       // Obtener las sucursales relacionadas a la empresa del usuario desde la tabla pivote empresa_sucursal
       $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
           $query->where('empresa_id', $this->empresa_id);
       })->get();
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
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-empresa.agregar-habilidades-tecnicas-empresa')->layout("layouts.portal_capacitacion");
    }
}
