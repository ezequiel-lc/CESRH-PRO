<?php

namespace App\Livewire\PortalCapacitacion\Evidencias\Individuales\AdminTrabajador;

use Livewire\Component;
use App\Models\PortalCapacitacion\CapacitacionIndividual;
use App\Models\PortalCapacitacion\Evidencia;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class MostrarEvidenciasIndividuales extends Component
{
    public $caps_individuales_id;  
    public $evidencias; 

    public function mount($id)
    {
        $this->caps_individuales_id = Crypt::decrypt($id);
    
        $capsIndividual = CapacitacionIndividual::find($this->caps_individuales_id);
        if ($capsIndividual) {
            $this->evidencias = $capsIndividual->evidencias;  // Obtener las evidencias asociadas
        }
    }

    public function render()
{
    return view('livewire.portal-capacitacion.evidencias.individuales.admin-trabajador.mostrar-evidencias-individuales', [
        'caps_individuales_id' => $this->caps_individuales_id
    ])->layout("layouts.portal_capacitacion");
}

}
