<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\RelacionExterna;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRh\Sucursal;

class AgregarRelacionesExternasEmpresa extends Component
{
    public $externa=[];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    protected $rules = [
        'externa.nombre' => 'required',
        'externa.razon_motivo' => 'required',
        'externa.frecuencia' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'externa.nombre.required' => 'El nombre es obligatorio.',
        'externa.razon_motivo.required' => 'La razón o motivo es obligatorio.',
        'externa.frecuencia.required' => 'El frecuencia es obligatorio.',
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

    public function updatedEmpresaId()
    {
        // Obtener las sucursales de la empresa seleccionada usando la tabla pivote
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        // Resetear la sucursal seleccionada al cambiar de empresa
        $this->sucursal_id = null;
    }

    public function agregarExterna()
    {
        $this->validate();

        RelacionExterna::create([
            'nombre' => $this->externa['nombre'],
            'razon_motivo' => $this->externa['razon_motivo'],
            'frecuencia' => $this->externa['frecuencia'],
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        $this->externa = [];
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->sucursales = [];

        session()->flash('message', 'Relacion externa creada con exito');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.relaciones-externas.admin-empresa.agregar-relaciones-externas-empresa')->layout("layouts.portal_capacitacion");
    }
}
