<?php

namespace App\Livewire\PortalRh\Incidencias;

use Livewire\Component;
use App\Models\PortalRH\Incidencia;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;

class EditarIncidencias extends Component
{
    public $incidencia_id, $tipo_incidencia, $fecha_inicio, $fecha_final;

    public $sucursales=[], $departamentos=[], $users=[];
    public $empresas, $empresa, $sucursal, $departamento, $nombre_usuario;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $incidencia = Incidencia::findOrFail($id);
        $this->empresas = Empresa::all();

        // Asignar datos de la incidencia
        $this->incidencia_id  = $id;
        $this->tipo_incidencia = $incidencia->tipo_incidencia;
        $this->fecha_inicio    = $incidencia->fecha_inicio;
        $this->fecha_final     = $incidencia->fecha_final;

        $this->empresa = $incidencia->empresa_id;
        $this->sucursal = $incidencia->sucursal_id;
        $this->departamento = $incidencia->departamento_id;

        // Obtener el usuario asignado 
        if ($incidencia->users->isNotEmpty()) {
            $this->nombre_usuario = $incidencia->users->first()->name;
        } else {
            $this->nombre_usuario = 'No asignado';
        }
    }

    public function actualizarIncidencia()
    {
        $this->validate([
            'tipo_incidencia' => 'required',
            'fecha_inicio'    => 'required|date',
            'fecha_final'     => 'required|date|after_or_equal:fecha_inicio',
            //'empresa'         => 'required',
            //'sucursal'        => 'required',
            //'departamento'    => 'required',
            //'user_id'       => 'required|exists:users,id',
        ]);

        $incidencia = Incidencia::findOrFail($this->incidencia_id);
        $incidencia->update([
            'tipo_incidencia' => $this->tipo_incidencia,
            'fecha_inicio'    => $this->fecha_inicio,
            'fecha_final'     => $this->fecha_final,
            //'empresa_id'      => $this->empresa,
            //'sucursal_id'     => $this->sucursal,
            //'departamento_id' => $this->departamento,
        ]);

        // Actualizamos el usuario asignado en la relación many-to-many.
        // Se usa sync para reemplazar cualquier usuario previamente asociado.
        //$incidencia->users()->sync([$this->user_id]);

        session()->flash('message', 'Incidencia actualizada exitosamente.');
    }

    public function render()
    {
        return view('livewire.portal-rh.incidencias.editar-incidencias')->layout('layouts.client');
    }
}
