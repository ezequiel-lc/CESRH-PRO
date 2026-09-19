<?php

namespace App\Livewire\Portal360\Envaluaciones\EnvalaucionesTrabajador;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\Encpre;
use App\Models\Encuestas360\RespuestaUsuario;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class EncuestaEnvaluacionPregunta extends Component
{
    use WithPagination;

    public $asignacionId;
    public $asignacion;
    public $calificador;
    public $calificado;
    public $preguntas = [];
    public $respuestas = []; // Stores user responses
    public $perPage = 5;
    public $perPageOptions = [5, 10, 15, 'all'];

    // public function mount($asignacionId)
    // {
    //     $this->asignacionId = $asignacionId;
    //     $this->loadEncuestaData();
    //     $this->restoreResponses();
    // }

    public function mount($asignacionId)
{
    $this->asignacionId = $asignacionId;
    
    // Cargar la asignación primero
    $asignacion = Asignacion::findOrFail($asignacionId);
    
    // Verificar si es el mismo día
    $hoy = \Illuminate\Support\Carbon::today();
    $fechaAsignacion = \Illuminate\Support\Carbon::parse($asignacion->fecha)->startOfDay();
    $esMismoDia = $hoy->equalTo($fechaAsignacion);
    
    // Redirigir si no es la fecha correcta
    if (!$esMismoDia) {
        $this->dispatch('toastr-success', message: 'Esta encuesta solo puede ser contestada en la fecha programada.');
        // session()->flash('error', 'Esta encuesta solo puede ser contestada en la fecha programada.');
        return redirect()->route('portal360.envaluaciones.envalauciones-trabajador.asignaciones-pendientes'); // Ruta actualizada
        return;
    }
    
    // Continuar con la carga normal si la fecha es correcta
    $this->asignacion = $asignacion;
    $this->loadEncuestaData();
    $this->restoreResponses();
}

    public function loadEncuestaData()
    {
        $this->asignacion = Asignacion::with(['encuesta', 'calificador', 'calificado'])->findOrFail($this->asignacionId);
        $this->calificador = $this->asignacion->calificador;
        $this->calificado = $this->asignacion->calificado;

        $this->preguntas = Encpre::where('encuestas_id', $this->asignacion->encuesta->id)
            ->with('pregunta.respuestas')
            ->get()
            ->pluck('pregunta')
            ->filter();

        // Initialize respuestas array with empty values for all questions
        $this->respuestas = $this->preguntas->mapWithKeys(function ($pregunta) {
            return [$pregunta->id => ''];
        })->toArray();
    }

    public function updatedRespuestas($value, $key)
    {
        // Save the response immediately when it changes
        $this->savePartialResponses();
    }

    public function savePartialResponses()
    {
        Log::info('Saving partial responses:', $this->respuestas);

        // Delete previous responses for this assignment
        RespuestaUsuario::where('asignaciones_id', $this->asignacionId)->delete();

        // Save new responses
        foreach ($this->respuestas as $preguntaId => $respuestaId) {
            if (!empty($respuestaId)) {
                RespuestaUsuario::create([
                    'respuesta360_id' => $respuestaId,
                    'asignaciones_id' => $this->asignacionId,
                    'pregunta_id' => $preguntaId,
                ]);
            }
        }
    }

    public function restoreResponses()
    {
        $savedResponses = RespuestaUsuario::where('asignaciones_id', $this->asignacionId)
            ->get()
            ->pluck('respuesta360_id', 'pregunta_id')
            ->toArray();

        // Merge saved responses into the component state
        foreach ($savedResponses as $preguntaId => $respuestaId) {
            if (isset($this->respuestas[$preguntaId])) {
                $this->respuestas[$preguntaId] = $respuestaId;
            }
        }
    }

    public function submit()
    {
        // Validar que todas las respuestas estén completas
        foreach ($this->respuestas as $preguntaId => $respuestaId) {
            if (empty($respuestaId)) {
                $this->dispatch('toastr-warning', message: 'Por favor, responde todas las preguntas antes de enviar la encuesta.');
                return;
            }
        }

        // Validar que las respuestas existan en la base de datos
        $this->validate([
            'respuestas.*' => 'required|exists:360_respuestas,id',
        ]);

        try {
            // Guardar todas las respuestas antes de completar
            $this->savePartialResponses();
            $this->asignacion->update(['realizada' => 1]);

            $this->dispatch('toastr-success', message: 'Encuesta completada exitosamente.');
            return redirect()->route('portal360.envaluaciones.envalauciones-trabajador.asignaciones-pendientes'); // Ruta actualizada
        } catch (\Exception $e) {
            Log::error('Error al guardar las respuestas: ' . $e->getMessage());
            $this->dispatch('toastr-error', message: 'Ocurrió un error al guardar las respuestas.');
        }
    }

    public function updatedPerPage($value)
    {
        if ($value === 'all') {
            $this->perPage = $this->preguntas->count();
        } else {
            $this->perPage = $value;
            $this->resetPage(); // Reset pagination when changing perPage
        }

        // Save responses when changing perPage to ensure nothing is lost
        $this->savePartialResponses();
    }

    // Important: Add this hook to restore responses when page changes
    public function updatedPage()
    {
        $this->savePartialResponses();
        $this->restoreResponses();
    }
    public function render()
    {
        $paginatedPreguntas = Encpre::where('encuestas_id', $this->asignacion->encuesta->id)
            ->with('pregunta.respuestas')
            ->paginate($this->perPage);

        return view('livewire.portal360.envaluaciones.envalauciones-trabajador.encuesta-envaluacion-pregunta', [
            'paginatedPreguntas' => $paginatedPreguntas,
        ])->layout('layouts.portal360');
    }
}
