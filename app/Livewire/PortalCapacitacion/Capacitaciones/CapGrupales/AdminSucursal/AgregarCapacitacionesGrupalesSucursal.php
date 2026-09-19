<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\PortalCapacitacion\Curso;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\EmpresaSucursal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AgregarCapacitacionesGrupalesSucursal extends Component
{
    public $nombreGrupo, $nombreCapacitacion, $fechaIni, $fechaFin, $cursos_id, $objetivo_capacitacion = [];
    public $cursos = [];
    public $usuario_id;
    public $empresa_id;
    public $sucursal_id;

    public function mount()
    {
        // Obtener el empresa_id y sucursal_id del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;
        $this->sucursal_id = Auth::user()->sucursal_id;

        // Cargar los cursos de la sucursal del usuario
        $this->cursos = Curso::where('empresa_id', $this->empresa_id)
                             ->where('sucursal_id', $this->sucursal_id)
                             ->get();
    }

    public function agregarCapacitacionGrupal()
    {
        $this->validate([
            'nombreGrupo' => 'required|string|max:255',
            'nombreCapacitacion' => 'required|string|max:255',
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaIni',
            'cursos_id' => 'required|exists:cursos,id',
            'objetivo_capacitacion' => 'required|string',
        ]);

        // Crear la capacitación
        $capacitacion = GrupocursoCapacitacion::create([
            'nombreGrupo' => $this->nombreGrupo,
            'nombreCapacitacion' => $this->nombreCapacitacion,
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
            'cursos_id' => $this->cursos_id,
            'objetivo_capacitacion' => $this->objetivo_capacitacion,
            'empresa_id' => $this->empresa_id, // Usar el empresa_id del usuario autenticado
            'sucursal_id' => $this->sucursal_id, // Usar el sucursal_id del usuario autenticado
        ]);

        // Asignar los cursos (si hay una relación muchos a muchos)
        if (method_exists($capacitacion, 'cursos')) {
            $capacitacion->cursos()->sync($this->cursos_id);
        }
        
        // Limpiar los inputs
        $this->reset(['nombreGrupo', 'nombreCapacitacion', 'fechaIni', 'fechaFin', 'cursos_id', 'objetivo_capacitacion']);

        Session::flash('message', 'Capacitación grupal creada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-sucursal.agregar-capacitaciones-grupales-sucursal', [
            'cursos' => $this->cursos,
        ])->layout("layouts.portal_capacitacion");
    }
}