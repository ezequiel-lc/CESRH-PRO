<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;

class AgregarRelacionesInternasEmpresa extends Component
{
    public $interna=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'interna.puesto' => 'required',
        'interna.razon_motivo' => 'required',
        'interna.frecuencia' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'interna.puesto.required' => 'El campo puesto es obligatorio',
        'interna.razon_motivo.required' => 'El campo razón motivo es obligatorio',
        'interna.frecuencia.required' => 'El campo frecuencia es obligatorio',
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
        return view('livewire.portal-capacitacion.relaciones-internas.admin-empresa.agregar-relaciones-internas-empresa')->layout("layouts.portal_capacitacion");
    }
}
