<?php

namespace App\Livewire\Dx035\CuestionarioUno;

use Livewire\Component;
use App\Models\Dx035\Encuesta;
use App\Models\Dx035\Cuestionario;
use App\Models\Dx035\TrabajadorEncuesta;
use App\Models\Dx035\Respuesta;

class ResponderCuestionario extends Component
{
    public $encuesta_clave;
    public $cuestionario;
    public $preguntas;
    public $respuestas = [];
    public $mostrarSeccionesAdicionales = false;

    public function mount(Request $request)
    {
        // Obtener la clave de la encuesta desde la solicitud GET
        $this->encuesta_clave = $request->query('encuesta_clave');

        // Validar que se haya proporcionado una clave
        if (!$this->encuesta_clave) {
            session()->flash('error', 'Debes ingresar una clave válida.');
            return redirect()->route('encuesta.index'); // Redirigir si no hay clave
        }

        // Obtener la encuesta y el cuestionario asociado
        $encuesta = Encuesta::find($this->encuesta_clave);

        if (!$encuesta) {
            session()->flash('error', 'La clave de la encuesta no es válida.');
            return redirect()->route('encuesta.index'); // Redirigir si la clave no existe
        }

        $this->cuestionario = $encuesta->cuestionarios()->first();

        // Obtener las preguntas del cuestionario
        $this->preguntas = $this->cuestionario->preguntasBases;

        // Inicializar las respuestas
        foreach ($this->preguntas as $pregunta) {
            $this->respuestas[$pregunta->id] = null; // Inicializar como null (sin respuesta)
        }
    }

    public function updatedRespuestas()
    {
        // Verificar si alguna respuesta en la Sección I es "Sí"
        $seccionI = $this->preguntas->where('Seccion', 'Acontecimiento traumático severo');
        foreach ($seccionI as $pregunta) {
            if ($this->respuestas[$pregunta->id] === 'Sí') {
                $this->mostrarSeccionesAdicionales = true;
                return;
            }
        }
        $this->mostrarSeccionesAdicionales = false;
    }

    public function submit()
    {
        // Validar que todas las preguntas obligatorias estén respondidas
        $this->validate([
            'respuestas.*' => 'required|in:Sí,No',
        ]);

        // Guardar las respuestas en la base de datos
        $trabajadorEncuesta = TrabajadorEncuesta::create([
            'Clave' => $this->encuesta_clave,
            'users_id' => auth()->id(), // Asumiendo que el usuario está autenticado
            'Avance' => 100, // Marcar como completado
        ]);

        foreach ($this->respuestas as $pregunta_id => $respuesta) {
            Respuesta::create([
                'trabajadores_encuestas_id' => $trabajadorEncuesta->id,
                'preguntas_bases_id' => $pregunta_id,
                'respuesta' => $respuesta,
            ]);
        }

        // Redirigir o mostrar un mensaje de éxito
        session()->flash('message', 'Encuesta completada exitosamente.');
        return redirect()->route('dashboard'); // Cambia 'dashboard' por la ruta que desees
    }

    public function render()
    {
        return view('livewire.dx035.cuestionario-uno.responder-cuestionario');
    }
}
