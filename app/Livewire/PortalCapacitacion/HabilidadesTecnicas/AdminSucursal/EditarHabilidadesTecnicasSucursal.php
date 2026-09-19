<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalRh\Sucursal;

class EditarHabilidadesTecnicasSucursal extends Component
{
    public $descripcion, $nivel, $tecnica_id;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    protected $rules = [
        'humana.descripcion' => 'required',
        'humana.nivel' => 'required',
    ];

    protected $messages = [
        'humana.descripcion.required' => 'La descripción es obligatoria.',
        'humana.nivel.required' => 'El nivel es obligatorio.',
    ];

    public function mount($id)
    {
        $id= Crypt::decrypt($id);
        $tem = FormacionHabilidadTecnica::findOrFail($id);

        $this->descripcion = $tem->descripcion;
        $this->nivel = $tem->nivel;
        $this->tecnica_id = $tem->id;
        $this->humana_id = $tem->id;
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

        return redirect()->route('mostrarHabiliadesTecnicasSucursal');        

    }

    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-tecnicas.admin-sucursal.editar-habilidades-tecnicas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
