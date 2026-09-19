<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionInterna;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class EditarRelacionesInternas extends Component
{
    use WithFileUploads;
    public $puesto, $razon_motivo, $frecuencia, $interna_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
        'puesto' =>'required',
        'razon_motivo' => 'required',
        'frecuencia' => 'required',
        'empresa_id' =>'required',
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
        $this->empresa_id = $tem->empresa_id;

        // Cargar todas las empresas
        $this->empresas = Empresa::all();

        // Cargar sucursales correspondientes a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $tem->sucursal_id;
    }

    public function updatedEmpresaId()
    {
        // Obtener sucursales relacionadas a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null; // Resetear selección de sucursal
    }

    public function store()
    {
        $this->validate([
            'puesto' =>'required',
            'razon_motivo' => 'required',
            'frecuencia' => 'required',
            'empresa_id' =>'required',
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
        return redirect()->route('mostrarRelacionesInternas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-internas.admin-general.editar-relaciones-internas')->layout("layouts.portal_capacitacion");
    }
}
