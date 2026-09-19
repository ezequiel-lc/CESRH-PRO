<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminSucursal;

use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditarHabilidadesHumanasSucursal extends Component
{
    public $descripcion, $nivel, $humana_id;
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
        $tem = FormacionHabilidadHumana::findOrFail($id);

        $this->descripcion = $tem->descripcion;
        $this->nivel = $tem->nivel;
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
        ]);

        FormacionHabilidadHumana::updateOrCreate(['id' => $this->humana_id],
        [
            'descripcion' => $this->descripcion,
            'nivel' => $this->nivel,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        return redirect()->route('mostrarHabiliadesHumanasSucursal');
        

    }
    public function render()
    {
        return view('livewire.portal-capacitacion.habilidades-humanas.admin-sucursal.editar-habilidades-humanas-sucursal')->layout("layouts.portal_capacitacion");
    }
}
