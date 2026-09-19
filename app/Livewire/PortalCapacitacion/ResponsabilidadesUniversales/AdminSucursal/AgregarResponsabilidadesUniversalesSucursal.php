<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminSucursal;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AgregarResponsabilidadesUniversalesSucursal extends Component
{
    public $universal=[];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'universal.sistema' => 'required',
        'universal.responsalidad' => 'required',
    ];

    protected $messages = [
        'universal.sistema' => 'El campo sistema es obligatorio',
        'universal.responsalidad' => 'El campo responsabilidad es obligatorio',
    ];

    public function mount()
    {
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
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

        session()->flash('message', 'Responsabilidad universal creada exitosamente.');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-sucursal.agregar-responsabilidades-universales-sucursal')->layout("layouts.portal_capacitacion");
    }
}
