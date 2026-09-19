<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRh\Sucursal;

class EditarResponsabilidadesUniversalesEmpresa extends Component
{
    public $sistema, $responsalidad, $universal_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
       'sistema' =>'required',
       'responsalidad' =>'required',
       'sucursal_id' =>'required',
    ];

    protected $messages = [
        'sistema.required' => 'El campo sistema es obligatorio',
       'responsalidad.required' => 'El campo responsabilidad es obligatorio',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.', 
    ];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tem = ResponsabilidadUniversal::findOrFail($id);

        $this->sistema = $tem->sistema;
        $this->responsalidad = $tem->responsalidad;
        $this->universal_id = $tem->id;
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
            'sistema' =>'required',
            'responsalidad' =>'required',
            'sucursal_id' =>'required',
        ]);

        ResponsabilidadUniversal::updateOrCreate(['id' => $this->universal_id],
        [   
           'sistema' => $this->sistema,
           'responsalidad' => $this->responsalidad,
           'empresa_id' => $this->empresa_id,
           'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarResponsabilidadesUniversalesEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-empresa.editar-responsabilidades-universales-empresa')->layout("layouts.portal_capacitacion");
    }
}
