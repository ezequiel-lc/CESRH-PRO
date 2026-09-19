<?php

namespace App\Livewire\PortalRh\CambioSalario;

use Livewire\Component;
use App\Models\PortalRH\CambioSalario;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditarCambioSalario extends Component
{
    use WithFileUploads;
    public $salario_id, $fecha_cambio, $salario_anterior, $salario_nuevo,
        $motivo, $documento, $observaciones, $subirPdf, $nombre_usuario
    ;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $cambio_salario = CambioSalario::findOrFail($id);
        
        $this->salario_id = $id;
        $this->fecha_cambio = $cambio_salario->fecha_cambio;
        $this->salario_anterior = $cambio_salario->salario_anterior;
        $this->salario_nuevo = $cambio_salario->salario_nuevo;
        $this->motivo = $cambio_salario->motivo;
        $this->observaciones = $cambio_salario->observaciones;
        $this->documento = $cambio_salario->documento;

        // Obtener el usuario asignado 
        if ($cambio_salario->users->isNotEmpty()) {
            $this->nombre_usuario = $cambio_salario->users->first()->name;
        } else {
            $this->nombre_usuario = 'No asignado';
        }
    }

    public function actualizarSalario()
    {
        $this->validate([
            'fecha_cambio' => 'required',
            'salario_anterior' => 'required',
            'salario_nuevo' => 'required',
            'motivo' => 'required',
            'observaciones' => 'required',
            'subirPdf' => 'nullable|file|mimes:pdf',
        ]);

        // si se subio un nuevo archivo PDF
        if ($this->subirPdf) {
            // eliminar el archivo PDF anterior si existe
            if ($this->documento && Storage::disk('subirDocs')->exists($this->documento)) {
                Storage::disk('subirDocs')->delete($this->documento);
            }

            // guardar el nuevo archivo PDF
            $this->subirPdf->storeAs('PortalRH/CambioSalario', $this->motivo . ".pdf", 'subirDocs');
            $this->documento = "PortalRH/CambioSalario/" . $this->motivo . ".pdf";
        }

        CambioSalario::updateOrCreate(['id' => $this->salario_id], [
            'fecha_cambio' => $this->fecha_cambio,
            'salario_anterior' => $this->salario_anterior,
            'salario_nuevo' => $this->salario_nuevo,
            'motivo' => $this->motivo,
            'observaciones' => $this->observaciones,
            'documento' => $this->documento,
        ]);
        
        session()->flash('message', 'Cambio de salario actualizado.');
    }
    
    public function render()
    {
        return view('livewire.portal-rh.cambio-salario.editar-cambio-salario')->layout('layouts.client');
    }
}
