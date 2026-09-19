<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class EditarRelacionesExternas extends Component
{
    public $nombre, $razon_motivo, $frecuencia, $externa_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tem = RelacionExterna::findOrFail($id);

        $this->nombre = $tem->nombre;
        $this->razon_motivo = $tem->razon_motivo;
        $this->frecuencia = $tem->frecuencia;
        $this->externa_id = $id;
        $this->empresa_id = $tem->empresa_id;

        // Cargar todas las empresas
        $this->empresas = Empresa::all();

        // Cargar sucursales correspondientes a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $tem->sucursal_id;
    }

    protected $rules = [
        'nombre' =>'required',
        'razon_motivo' =>'required',
        'frecuencia' =>'required',
        'empresa_id' =>'required',
        'sucursal_id' =>'required',
    ];

    protected $messages = [
        'nombre.required' => 'El campo Nombre es obligatorio',
        'razon_motivo.required' => 'El campo Razón del motivo es obligatorio',
        'frecuencia.required' => 'El campo Frecuencia es obligatorio',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.', 
    ];

    public function updatedEmpresaId()
    {
        // Obtener sucursales relacionadas a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null; // Resetear selección de sucursal
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'razon_motivo' => 'required',
            'frecuencia' => 'required',
            'empresa_id' =>'required',
            'sucursal_id' =>'required',
        ]);

        RelacionExterna::updateOrCreate(['id' => $this->externa_id],
        [
            'nombre' => $this->nombre,
            'razon_motivo' => $this->razon_motivo,
            'frecuencia' => $this->frecuencia,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarRelacionesExternas');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-general.editar-relaciones-externas')->layout("layouts.portal_capacitacion");
    }
}
