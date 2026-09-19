<?php 

namespace App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminSucursal;

use Livewire\Component;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Instructor;
use Illuminate\Support\Facades\Auth;

class AsociarPuestoTrabajadorSucursal extends Component
{
    public $empresa_id;
    public $sucursal_id;
    public $tipo_seleccionado;
    public $opciones = [];

    public function mount()
    {
        // Obtener la empresa y sucursal del usuario autenticado
        $usuario = Auth::user();
        $this->empresa_id = $usuario->empresa_id;
        $this->sucursal_id = $usuario->sucursal_id;
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
                $query->where('empresa_id', $this->empresa_id)
                      ->where('sucursal_id', $this->sucursal_id);
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
        return view('livewire.portal-capacitacion.asociar-puesto-trabajador.admin-sucursal.asociar-puesto-trabajador-sucursal')
            ->layout("layouts.portal_capacitacion");
    }
}
