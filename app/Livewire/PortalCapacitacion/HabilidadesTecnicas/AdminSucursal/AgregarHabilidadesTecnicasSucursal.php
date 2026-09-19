<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica; 
use Illuminate\Support\Facades\Auth;

class AgregarHabilidadesTecnicasSucursal extends Component
{
    public $tecnica=[];
    public $empresa_id;
    public $sucursal_id; 

    protected $rules = [
        'tecnica.descripcion' => 'required',
        'tecnica.nivel' => 'required',
    ];

    protected $messages = [
        'tecnica.descripcion.required' => 'La descripción es obligatoria.',
        'tecnica.nivel.required' => 'El nivel es obligatorio.',
    ];

    public function mount()
    {
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
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
        $this->tecnica = [];

        session()->flash('message', 'Habilidad Tecnica creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-sucursal.agregar-habilidades-tecnicas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
