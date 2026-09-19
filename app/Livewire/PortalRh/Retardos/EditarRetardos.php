<?php

namespace App\Livewire\PortalRh\Retardos;

use Livewire\Component;
use App\Models\PortalRH\Retardo;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class EditarRetardos extends Component
{
    public $retardo_id, $fecha, $hora_entrada_programada, $hora_entrada_real,
        $minutos_retardo, $motivo, $status, $nombre_usuario;
    
    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $retardo = Retardo::findOrFail($id);

        $this->retardo_id  = $id;
        $this->fecha = $retardo->fecha;
        $this->hora_entrada_programada = $retardo->hora_entrada_programada;
        $this->hora_entrada_real     = $retardo->hora_entrada_real;
        $this->minutos_retardo = $retardo->minutos_retardo;
        $this->motivo = $retardo->motivo;
        $this->status = $retardo->status;

        // Obtener el usuario asignado 
        if ($retardo->users->isNotEmpty()) {
            $this->nombre_usuario = $retardo->users->first()->name;
        } else {
            $this->nombre_usuario = 'No asignado';
        }
    }

    public function actualizarRetardo()
    {
        $this->validate([
            'fecha' => 'required',
            'hora_entrada_programada'    => 'required',
            'hora_entrada_real'     => 'required',
            'minutos_retardo' => 'required',
            'motivo' => 'required',
            'status' => 'required',
            //'empresa'         => 'required',
            //'sucursal'        => 'required',
            //'departamento'    => 'required',
            //'user_id'       => 'required|exists:users,id',
        ]);

        $retardo = Retardo::findOrFail($this->retardo_id);
        $retardo->update([
            'fecha'                    => $this->fecha,
            'hora_entrada_programada'  => $this->hora_entrada_programada,
            'hora_entrada_real'        => $this->hora_entrada_real,
            'minutos_retardo'          => $this->minutos_retardo,
            'motivo'                   => $this->motivo,
            'status'                   => $this->status,
            //'empresa_id'      => $this->empresa,
            //'sucursal_id'     => $this->sucursal,
            //'departamento_id' => $this->departamento,
        ]);

        // Actualizamos el usuario asignado en la relación many-to-many.
        // Se usa sync para reemplazar cualquier usuario previamente asociado.
        //$retardo->users()->sync([$this->user_id]);

        session()->flash('message', 'Retardo actualizado.');
    }

    public function render()
    {
        return view('livewire.portal-rh.retardos.editar-retardos')->layout('layouts.client');
    }
}
