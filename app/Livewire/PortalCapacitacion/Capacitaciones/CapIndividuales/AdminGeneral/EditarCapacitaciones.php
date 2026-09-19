<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\CapacitacionIndividual;
use App\Models\PortalCapacitacion\Curso;
use Illuminate\Support\Facades\Crypt;

class EditarCapacitaciones extends Component
{
    public $fechaIni, $fechaFin, $nombreCapacitacion, $objetivoCapacitacion, $cursos_id = [];
    public $cursos = [];
    public $usuario_id, $capacitacion_id; // Agregado el id de la capacitación para editar
    public $capacitacion;

    public function mount($id)
    {
        // Desencriptar el id recibido
        $this->capacitacion_id = Crypt::decrypt($id);

        // Buscar la capacitación y cargar la relación de curso
        $this->capacitacion = CapacitacionIndividual::find($this->capacitacion_id);

        if (!$this->capacitacion) {
            session()->flash('error', 'Capacitación no encontrada.');
            return redirect()->route('verCapacitacionesInd', ['id' => $this->usuario_id]);
        }

        // Cargar los cursos disponibles
        $this->cursos = Curso::all();

        // Rellenar los campos con los datos de la capacitación a editar
        $this->fechaIni = $this->capacitacion->fechaIni;
        $this->fechaFin = $this->capacitacion->fechaFin;
        $this->nombreCapacitacion = $this->capacitacion->nombreCapacitacion;
        $this->objetivoCapacitacion = $this->capacitacion->objetivoCapacitacion;

        // Cargar el id del curso relacionado
        $this->cursos_id = $this->capacitacion->curso ? [$this->capacitacion->curso->id] : [];
    }

    public function actualizarCapacitacion()
    {
        $this->validate([
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaIni',
            'nombreCapacitacion' => 'required',
            'objetivoCapacitacion' => 'required'
        ]);

        // Actualizar la capacitación
        $this->capacitacion->update([
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
            'nombreCapacitacion' => $this->nombreCapacitacion,
            'objetivoCapacitacion' => $this->objetivoCapacitacion,
        ]);

        // Actualizar la relación de cursos (si es necesario)
        if (method_exists($this->capacitacion, 'cursos')) {
            $this->capacitacion->cursos()->sync($this->cursos_id);
        }

        session()->flash('message', 'Capacitación actualizada correctamente.');

        // Limpiar los campos o redirigir
        return redirect()->route('verCapacitacionesInd', ['id' => $this->usuario_id]);
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-individuales.admin-general.editar-capacitaciones', [
            'cursos' => $this->cursos,
        ])->layout("layouts.portal_capacitacion");
    }
}
