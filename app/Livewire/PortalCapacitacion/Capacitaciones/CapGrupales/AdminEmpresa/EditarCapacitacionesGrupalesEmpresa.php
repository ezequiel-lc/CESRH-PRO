<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminEmpresa;

use Livewire\Component;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\PortalCapacitacion\Curso;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Session;

class EditarCapacitacionesGrupalesEmpresa extends Component
{
    public $nombreGrupo, $nombreCapacitacion, $fechaIni, $fechaFin, $cursos_id, $objetivo_capacitacion = [];
    public $cursos = [];
    public $usuario_id, $capacitacion_id;
    public $capacitacion;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    public function mount($id)
    {
        // Desencriptar el id recibido
        $this->capacitacion_id = Crypt::decrypt($id);

        // Buscar la capacitación y cargar la relación de curso
        $this->capacitacion = GrupocursoCapacitacion::find($this->capacitacion_id);

        // Cargar los cursos disponibles
        $this->cursos = Curso::all();

        // Rellenar los campos con los datos de la capacitación a editar
        $this->nombreGrupo = $this->capacitacion->nombreGrupo;
        $this->nombreCapacitacion = $this->capacitacion->nombreCapacitacion;
        $this->fechaIni = $this->capacitacion->fechaIni;
        $this->fechaFin = $this->capacitacion->fechaFin;
        $this->cursos_id = $this->capacitacion->curso ? [$this->capacitacion->curso->id] : [];
        $this->objetivo_capacitacion = $this->capacitacion->objetivo_capacitacion;

        $this->empresa_id = $this->capacitacion->empresa_id;
        $this->empresas = Empresa::all();
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = $this->capacitacion->sucursal_id;
    }

    public function updateEmpresaId()
    {
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null;
        $this->cursos = [];
    }

    public function updatedSucursalId()
    {
        if ($this->empresa_id && $this->sucursal_id) {
            $this->cursos = Curso::where('empresa_id', $this->empresa_id)
                                       ->where('sucursal_id', $this->sucursal_id)
                                       ->get();
        } else {
            $this->cursos = [];
        }
    }


    public function actualizarCapacitacionGrupal()
    {
        $this->validate([
            'nombreGrupo' => 'required|string|max:255',
            'nombreCapacitacion' => 'required|string|max:255',
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaIni',
            'objetivo_capacitacion' => 'required|string',
            'empresa_id' => 'required',
            'sucursal_id' => 'required',
        ]);

        // Actualizar la capacitación
        $this->capacitacion->update([
            'nombreGrupo' => $this->nombreGrupo,
            'nombreCapacitacion' => $this->nombreCapacitacion,
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
            'objetivo_capacitacion' => $this->objetivo_capacitacion,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        if (method_exists($this->capacitacion, 'cursos')) {
            $this->capacitacion->cursos()->sync($this->cursos_id);
        }
        
        Session::flash('message', 'Capacitación grupal actualizada correctamente.');

        // Limpiar los campos o redirigir
        return redirect()->route('verCapacitacionesGruEmpresa');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-empresa.editar-capacitaciones-grupales-empresa', [
            'cursos' => $this->cursos,
            'empresas' => $this->empresas,
            'sucursales' => $this->sucursales,
        ])->layout("layouts.portal_capacitacion");
    }
} 