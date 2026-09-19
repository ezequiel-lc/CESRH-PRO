<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;

class EditarRelacionesInternasEmpresa extends Component
{
    public $puesto, $razon_motivo, $frecuencia, $interna_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
        'puesto' =>'required',
        'razon_motivo' => 'required',
        'frecuencia' => 'required',
       'sucursal_id' =>'required',
    ];

    protected $messages = [
        'puesto.required' => 'El campo puesto es obligatorio',
        'razon_motivo.required' => 'El campo razón motivo es obligatorio',
        'frecuencia.required' => 'El campo frecuencia es obligatorio',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tem = RelacionInterna::findOrFail($id);

        $this->puesto = $tem->puesto;
        $this->razon_motivo = $tem->razon_motivo;
        $this->frecuencia = $tem->frecuencia;
        $this->interna_id = $tem->id;
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener sucursales relacionadas a la empresa desde la tabla pivote empresa_sucursal
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $funcion->sucursal_id;
    }

    public function store()
    {
        $this->validate([
            'puesto' =>'required',
            'razon_motivo' => 'required',
            'frecuencia' => 'required',
            'sucursal_id' =>'required',
        ]);

        RelacionInterna::updateOrCreate(['id' => $this->interna_id],
        [   
            'puesto' => $this->puesto,
            'razon_motivo' => $this->razon_motivo,
            'frecuencia' => $this->frecuencia,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);
        return redirect()->route('mostrarRelacionesInternasEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-empresa.editar-relaciones-internas-empresa')->layout("layouts.portal_capacitacion");
    }
}
