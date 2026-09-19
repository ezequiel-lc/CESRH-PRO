<?php

namespace App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Instructor;
use Illuminate\Support\Facades\Auth;

class AsociarPuestoTrabajadorEmpresa extends Component
{
    public $empresa_id;
    public $sucursales;
    public $sucursal_id;
    public $tipo_seleccionado;
    public $opciones = [];

    public function mount()
    {
        // Obtener la empresa del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;

        // Obtener solo las sucursales asociadas a esta empresa
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', $this->empresa_id);
        })->get();
    }

    public function updatedSucursalId()
    {
        $this->tipo_seleccionado = null;
        $this->opciones = [];
    }

    public function updatedTipoSeleccionado()
    {
        $modelos = [
            'trabajador' => Trabajador::class,
            'becario' => Becario::class,
            'practicante' => Practicante::class,
            'instructor' => Instructor::class,
        ];

        if (isset($modelos[$this->tipo_seleccionado])) {
            $this->opciones = $modelos[$this->tipo_seleccionado]::whereHas('usuarios', function ($query) {
                $query->where('sucursal_id', $this->sucursal_id);
            })->with('usuarios')->get();
        } else {
            $this->opciones = [];
        }
    }

    public function setTipo($tipo)
    {
        $this->tipo_seleccionado = $tipo;
        $this->updatedTipoSeleccionado();
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.asociar-puesto-trabajador.admin-empresa.asociar-puesto-trabajador-empresa')
            ->layout("layouts.portal_capacitacion");
    }
}
