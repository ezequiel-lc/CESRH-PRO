<?php

namespace App\Livewire\PortalCapacitacion\Evidencias\Individuales\AdminTrabajador;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PortalCapacitacion\Evidencia;
use App\Models\PortalCapacitacion\CapacitacionIndividual; // Asegúrate de importar el modelo CapsIndividual
use Illuminate\Support\Facades\Crypt;

class AgregarEvidenciasIndividuales extends Component
{
    use WithFileUploads; // Habilitar la carga de archivos

    public $evidencias; // Para la imagen
    public $comentarios;
    public $status;
    public $fecha;    
    public $caps_individuales_id; // ID de la capacitación individual

    public function mount($id)
    {
        // Desencriptar el ID de la capacitación individual
        $this->caps_individuales_id = Crypt::decrypt($id);
    }

    public function save()
{
    // Validar los datos
    $this->validate([
        'evidencias' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'comentarios' => 'nullable|string|max:500',
        'status' => 'required|string',
        'fecha' => 'required|date',
    ]);

    // Definir la carpeta de destino en "public/EvidenciasInd"
    $carpetaDestino = 'EvidenciasInd';

    // Obtener el nombre original del archivo
    $nombreArchivo = $this->evidencias->getClientOriginalName();

    // Guardar la imagen en "public/EvidenciasInd"
    $imagePath = $this->evidencias->storeAs($carpetaDestino, $nombreArchivo, 'public');

    // Guardar la ruta en la base de datos
    $evidencia = Evidencia::create([
        'evidencias' => $imagePath, // Guardamos la ruta relativa
        'comentarios' => $this->comentarios,
        'status' => $this->status,
        'fecha' => $this->fecha,
    ]);

    // Relacionar la evidencia con la capacitación individual
    $capsIndividual = CapacitacionIndividual::find($this->caps_individuales_id);
    if ($capsIndividual) {
        $capsIndividual->evidencias()->attach($evidencia->id);
    }

    // Mensaje de éxito
    session()->flash('message', 'Evidencia agregada exitosamente.');

    // Limpiar los campos
    $this->reset();
}


    public function render()
    {
        return view('livewire.portal-capacitacion.evidencias.individuales.admin-trabajador.agregar-evidencias-individuales')
            ->layout("layouts.portal_capacitacion");
    }
}
