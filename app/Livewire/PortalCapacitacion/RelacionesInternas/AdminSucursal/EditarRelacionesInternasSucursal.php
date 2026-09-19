<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;

class EditarRelacionesInternasSucursal extends Component
{
    public $puesto, $razon_motivo, $frecuencia, $interna_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
        'puesto' =>'required',
        'razon_motivo' => 'required',
        'frecuencia' => 'required',
    ];

    protected $messages = [
        'puesto.required' => 'El campo puesto es obligatorio',
        'razon_motivo.required' => 'El campo razón motivo es obligatorio',
        'frecuencia.required' => 'El campo frecuencia es obligatorio',
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
        $this->sucursal_id = $tem->sucursal_id;
    }

    public function store()
    {
        $this->validate([
            'puesto' =>'required',
            'razon_motivo' => 'required',
            'frecuencia' => 'required',
        ]);

        RelacionInterna::updateOrCreate(['id' => $this->interna_id],
        [   
            'puesto' => $this->puesto,
            'razon_motivo' => $this->razon_motivo,
            'frecuencia' => $this->frecuencia,
        ]);
        return redirect()->route('mostrarRelacionesInternasSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-sucursal.editar-relaciones-internas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
