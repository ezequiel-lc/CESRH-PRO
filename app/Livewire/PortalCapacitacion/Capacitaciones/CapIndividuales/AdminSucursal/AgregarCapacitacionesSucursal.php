<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\CapacitacionIndividual;
use App\Models\PortalCapacitacion\Curso;
use Illuminate\Support\Facades\Crypt;

class AgregarCapacitacionesSucursal extends Component
{
    public $fechaIni, $fechaFin, $nombreCapacitacion, $objetivoCapacitacion, $cursos_id = [];
    public $cursos = [];
    public $usuario_id; 

    public function mount($id)
    {
        // Desencriptar el id recibido
        $this->usuario_id = Crypt::decrypt($id);

        // Buscar la capacitación
        $this->capacitacion = CapacitacionIndividual::find($id);

        if (!$this->capacitacion) {
            session()->flash('error', 'Capacitación no encontrada.');
            
        }

        // Cargar los cursos disponibles
        $this->cursos = Curso::all();
    }

    public function asignarCapacitacion()
    {
        $this->validate([
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaIni',
            'nombreCapacitacion' => 'required|string|max:255',
            'objetivoCapacitacion' => 'required|string',
            'cursos_id' => 'required|exists:cursos,id', // Verifica que el curso exista en la BD
        ]);

        // Crear la capacitación
        $capacitacion = CapacitacionIndividual::create([
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
            'nombreCapacitacion' => $this->nombreCapacitacion,
            'objetivoCapacitacion' => $this->objetivoCapacitacion,
            'cursos_id' => $this->cursos_id, // Asegúrate de que se envía
        ]);

        // Asignar los cursos (si hay una relación muchos a muchos)
        if (method_exists($capacitacion, 'cursos')) {
            $capacitacion->cursos()->sync($this->cursos_id);
        }

        $capacitacion->usuarios()->attach($this->usuario_id);
        // Limpiar los inputs
        $this->reset(['fechaIni', 'fechaFin', 'nombreCapacitacion', 'objetivoCapacitacion', 'cursos_id']);

        session()->flash('message', 'Capacitación asignada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-individuales.admin-sucursal.agregar-capacitaciones-sucursal', [
            'cursos' => $this->cursos,
        ])->layout("layouts.portal_capacitacion");
    }
}
