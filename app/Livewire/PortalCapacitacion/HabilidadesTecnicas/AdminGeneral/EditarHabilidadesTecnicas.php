<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;

class EditarHabilidadesTecnicas extends Component
{
    use WithFileUploads;
    public $descripcion, $nivel, $tecnica_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
        'humana.descripcion' => 'required',
        'humana.nivel' => 'required',
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
    ];

    protected $messages = [
        'humana.descripcion.required' => 'La descripción es obligatoria.',
        'humana.nivel.required' => 'El nivel es obligatorio.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
    ];

    public function mount($id)
    {
        $id= Crypt::decrypt($id);
        $tem = FormacionHabilidadTecnica::findOrFail($id);

        $this->descripcion = $tem->descripcion;
        $this->nivel = $tem->nivel;
        $this->tecnica_id = $tem->id;
        $this->humana_id = $tem->id;
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
            'descripcion' => 'required',
            'nivel' => 'required',
            'empresa_id' => 'required',
            'sucursal_id' => 'required',
        ]);

        FormacionHabilidadTecnica::updateOrCreate(['id' => $this->tecnica_id],
        [
            'descripcion' => $this->descripcion,
            'nivel' => $this->nivel,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarHabiliadesTecnicas');        

    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-general.editar-habilidades-tecnicas')->layout("layouts.portal_capacitacion");
    }
}
