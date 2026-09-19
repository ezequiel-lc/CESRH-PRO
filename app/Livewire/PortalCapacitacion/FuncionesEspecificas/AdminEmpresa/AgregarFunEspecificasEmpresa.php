<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;

class AgregarFunEspecificasEmpresa extends Component
{
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id; 
    public $funcion = [];

    protected $rules = [
        'sucursal_id' => 'required',
        'funcion.nombre' => 'required',
    ];

    protected $messages = [
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'funcion.nombre.required' => 'La función específica es obligatoria.',
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

    public function agregarFuncion()
    {
        $this->validate();

        FuncionEspecifica::create([
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
            'nombre' => $this->funcion['nombre']
        ]);

        // Resetear valores después de guardar
        $this->sucursal_id = null;
        $this->funcion = [];

        session()->flash('message', 'Función específica agregada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.funciones-especificas.admin-empresa.agregar-fun-especificas-empresa')
            ->layout("layouts.portal_capacitacion");
    }
}
