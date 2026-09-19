<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRH\Sucursal;

class AgregarHabilidadesHumanasEmpresa extends Component
{
    public $humana=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'humana.descripcion' => 'required',
        'humana.nivel' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'humana.descripcion.required' => 'La descripción es obligatoria.',
        'humana.nivel.required' => 'El nivel es obligatorio.',
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
        return view('livewire.portal-capacitacion.habilidades-humanas.admin-empresa.agregar-habilidades-humanas-empresa')->layout("layouts.portal_capacitacion");
    }
}
