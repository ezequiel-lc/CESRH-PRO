<?php

namespace App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminGeneral;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Instructor;
use App\Models\User;

class AsociarPuestoTrabajador extends Component
{
    public $empresas;
    public $empresa_id;
    public $sucursales;
    public $sucursal_id;
    public $tipo_seleccionado;
    public $opciones = [];

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->sucursales = Sucursal::all();
    }

    public function updatedEmpresaId()
    {
        // Obtener las sucursales a través de la tabla pivote empresa_sucursal
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null;
        $this->tipo_seleccionado = null;
        $this->opciones = [];
    }

    public function updatedSucursalId()
    {
        $this->tipo_seleccionado = null;
        $this->opciones = [];
    }

    public function updatedTipoSeleccionado()
    {
        // Verificar si el tipo seleccionado es 'trabajador'
        if ($this->tipo_seleccionado == 'trabajador') {
            $this->opciones = Trabajador::whereHas('usuarios', function($query) {
                $query->where('sucursal_id', $this->sucursal_id);
            })->with('usuarios')->get();
        } 
        // Verificar si el tipo seleccionado es 'becario'
        elseif ($this->tipo_seleccionado == 'becario') {
            $this->opciones = Becario::whereHas('usuarios', function($query) {
                $query->where('sucursal_id', $this->sucursal_id);
            })->with('usuarios')->get();
        } 
        // Verificar si el tipo seleccionado es 'practicante'
        elseif ($this->tipo_seleccionado == 'practicante') {
            $this->opciones = Practicante::whereHas('usuarios', function($query) {
                $query->where('sucursal_id', $this->sucursal_id);
            })->with('usuarios')->get();
        } 
        // Verificar si el tipo seleccionado es 'instructor_id'
        elseif ($this->tipo_seleccionado == 'instructor') {
            $this->opciones = Instructor::whereHas('usuarios', function($query) {
                $query->where('sucursal_id', $this->sucursal_id);
            })->with('usuarios')->get();
        } 
        // Si no se seleccionó ningún tipo, se retorna un arreglo vacío
        else {
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
        return view('livewire.portal-capacitacion.asociar-puesto-trabajador.admin-general.asociar-puesto-trabajador')
            ->layout("layouts.portal_capacitacion");
    }
}