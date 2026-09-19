<?php

namespace App\Livewire\PortalRh\Bajas;

use Livewire\Component;
use App\Models\PortalRH\Baja;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditarBaja extends Component
{
    use WithFileUploads;

    public $baja_id, $fecha_baja, $motivo_baja, $tipo_baja, 
    $documento, $pdfdocumento, $observaciones, $nombre_usuario;
    

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $baja = Baja::findOrFail($id);

        // Asignar datos de la incidencia
        $this->baja_id  = $id;
        $this->fecha_baja = $baja->fecha_baja;
        $this->motivo_baja = $baja->motivo_baja;
        $this->tipo_baja = $baja->tipo_baja;
        $this->documento = $baja->documento;
        $this->observaciones = $baja->observaciones;

        // Obtener el usuario asignado 
        if (!is_null($baja->user)) {
            $this->nombre_usuario = $baja->user->name;
        } else {
            $this->nombre_usuario = 'No asignado';
        }        
    }

    public function actualizarBaja()
    {
        $this->validate([
            'fecha_baja' => 'required',
            'motivo_baja' => 'required',
            'tipo_baja' => 'required',
            'observaciones' => 'nullable',
            'pdfdocumento' => 'nullable|file',
        ]);

        // si se subio un nuevo archivo PDF
        if ($this->pdfdocumento) {
            // eliminar el archivo PDF anterior si existe
            if ($this->documento && Storage::disk('subirDocs')->exists($this->documento)) {
                Storage::disk('subirDocs')->delete($this->documento);
            }

            // guardar el nuevo archivo PDF
            $this->pdfdocumento->storeAs('PortalRH/Bajas', $this->motivo_baja .".pdf", 'subirDocs');
            $this->documento = "PortalRH/Bajas/" . $this->motivo_baja .".pdf";
        }

        Baja::updateOrCreate(['id' => $this->baja_id], [
            'fecha_baja' => $this->fecha_baja,
            'motivo_baja' => $this->motivo_baja,
            'tipo_baja' => $this->tipo_baja,
            'observaciones' => $this->observaciones,
            'documento' => $this->documento,
        ]);

        session()->flash('message', 'Notificación');
    }

    public function render()
    {
        return view('livewire.portal-rh.bajas.editar-baja')->layout('layouts.client');
    }
}
