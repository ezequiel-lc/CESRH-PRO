<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRh\Sucursal;

class AgregarResponsabilidadesUniversalesEmpresa extends Component
{
    public $universal=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'universal.sistema' => 'required',
        'universal.responsalidad' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'universal.sistema' => 'El campo sistema es obligatorio',
        'universal.responsalidad' => 'El campo responsabilidad es obligatorio',
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
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-empresa.agregar-responsabilidades-universales-empresa')->layout("layouts.portal_capacitacion");
    }
}
