<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class EditarResponsabilidadesUniversales extends Component
{
    use WithFileUploads;
    public $sistema, $responsalidad, $universal_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
       'sistema' =>'required',
       'responsalidad' =>'required',
       'empresa_id' =>'required',
       'sucursal_id' =>'required',
    ];

    protected $messages = [
        'sistema.required' => 'El campo sistema es obligatorio',
       'responsalidad.required' => 'El campo responsabilidad es obligatorio',
       'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.', 
    ];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tem = ResponsabilidadUniversal::findOrFail($id);

        $this->sistema = $tem->sistema;
        $this->responsalidad = $tem->responsalidad;
        $this->universal_id = $tem->id;
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
            'sistema' =>'required',
            'responsalidad' =>'required',
            'empresa_id' =>'required',
            'sucursal_id' =>'required',
        ]);

        ResponsabilidadUniversal::updateOrCreate(['id' => $this->universal_id],
        [   
           'sistema' => $this->sistema,
           'responsalidad' => $this->responsalidad,
           'empresa_id' => $this->empresa_id,
           'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarResponsabilidadesUniversales');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.responsabilidad-universal.admin-general.editar-responsabilidades-universales')->layout("layouts.portal_capacitacion");
    }
}
