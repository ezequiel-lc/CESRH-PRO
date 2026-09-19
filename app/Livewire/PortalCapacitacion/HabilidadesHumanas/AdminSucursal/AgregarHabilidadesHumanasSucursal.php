<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use Illuminate\Support\Facades\Auth;

class AgregarHabilidadesHumanasSucursal extends Component
{
    public $humana=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'humana.descripcion' => 'required',
        'humana.nivel' => 'required',
    ];

    protected $messages = [
        'humana.descripcion.required' => 'La descripción es obligatoria.',
        'humana.nivel.required' => 'El nivel es obligatorio.',
    ];

    public function mount()
    {
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
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
        $this->humana = [];
        
        session()->flash('message', 'Habilidda Humana creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-humanas.admin-sucursal.agregar-habilidades-humanas-sucursal')->layout("layouts.portal_capacitacion");
   
    }
}
