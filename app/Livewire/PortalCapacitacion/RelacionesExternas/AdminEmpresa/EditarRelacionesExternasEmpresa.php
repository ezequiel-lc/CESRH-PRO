<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Sucursal;

class EditarRelacionesExternasEmpresa extends Component
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
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener sucursales relacionadas a la empresa desde la tabla pivote empresa_sucursal
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $funcion->sucursal_id;
    }

    protected $rules = [
        'nombre' =>'required',
        'razon_motivo' =>'required',
        'frecuencia' =>'required',
    ];

    protected $messages = [
        'nombre.required' => 'El campo Nombre es obligatorio',
        'razon_motivo.required' => 'El campo Razón del motivo es obligatorio',
        'frecuencia.required' => 'El campo Frecuencia es obligatorio',
    ];

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'razon_motivo' => 'required',
            'frecuencia' => 'required',
        ]);

        RelacionExterna::updateOrCreate(['id' => $this->externa_id],
        [
            'nombre' => $this->nombre,
            'razon_motivo' => $this->razon_motivo,
            'frecuencia' => $this->frecuencia,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarRelacionesExternasEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-empresa.editar-relaciones-externas-empresa')->layout("layouts.portal_capacitacion");
    }
}
