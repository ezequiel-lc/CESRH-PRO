<?php

namespace App\Livewire\Dx035\CuestionarioParaResponder;

use Livewire\Component;
use App\Models\Dx035\Encuesta;
use App\Models\Dx035\PreguntaBase;
use App\Models\Dx035\TrabajadorEncuesta;
use App\Models\Dx035\Respuesta;
use Illuminate\Support\Facades\Session;

use App\Models\Dx035\DatoTrabajador;

use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\SucursalDepartamento;
use App\Models\PortalRH\EmpresSucursal;
use App\Models\PortalRH\Departamento;

class ResponderCuestionarioUno extends Component
{

    public $currentStep = 0; // Nuevo paso 0 para datos personales
    public $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $edad, $estadoCivil, $estudios, $ocupacion, $departamento, $tipoPuesto, $contratacion, $tipoPersonal, $jornadaTrabajo, $rotacionTurnos, $experiencia, $tiempoPuesto;

    public $sinFormacion;
    public $estudiosPrimaria;
    public $estudiosSecundaria;

    public $departamentos = [];

    public $encuesta;
    public $preguntas;
    public $respuestas = [];
    public $mostrarSeccionesAdicionales = false;
    public $cuestionarioId;
    public $atencionClientes = null; // Pregunta clave: Atención a clientes
    public $esJefe = null; // Pregunta clave: Es jefe

   // public $currentStep = 1;
    public $avance = 0;

    // Reglas de validación para los datos personales
    protected $rules = [
        'nombre' => 'nullable|string|max:45',
        'apellidoPaterno' => 'nullable|string|max:45',
        'apellidoMaterno' => 'nullable|string|max:45',
        'sexo' => 'nullable|string|max:45',
        'edad' => 'nullable|string|max:45',
        'estadoCivil' => 'nullable|string|max:45',
        'estudios' => 'nullable|string|max:45',
        'ocupacion' => 'nullable|string|max:45',
        'departamento' => 'nullable|string|max:45',
        'tipoPuesto' => 'nullable|string|max:45',
        'contratacion' => 'nullable|string|max:45',
        'tipoPersonal' => 'nullable|string|max:45',
        'jornadaTrabajo' => 'nullable|string|max:45',
        'rotacionTurnos' => 'nullable|string|max:45',
        'experiencia' => 'nullable|string|max:45',
        'tiempoPuesto' => 'nullable|string|max:45',
    ];

    // Método para guardar los datos personales
    public function saveDatosPersonales()
    {
        $this->validate();

        // Crear un nuevo registro en la tabla dato_trabajadores
        $datoTrabajador = DatoTrabajador::create([
            'Nombre' => $this->nombre,
            'ApellidoPaterno' => $this->apellidoPaterno,
            'ApellidoMaterno' => $this->apellidoMaterno,
            'Sexo' => $this->sexo,
            'Edad' => $this->edad,
            'EstadoCivil' => $this->estadoCivil,
            'Estudios' => $this->estudios,
            'Ocupacion' => $this->ocupacion,
            'Departamento' => $this->departamento,
            'TipoPuesto' => $this->tipoPuesto,
            'Contratacion' => $this->contratacion,
            'TipoPersonal' => $this->tipoPersonal,
            'JornadaTrabajo' => $this->jornadaTrabajo,
            'RotacionTurnos' => $this->rotacionTurnos,
            'Experiencia' => $this->experiencia,
            'TiempoPuesto' => $this->tiempoPuesto,
            'encuestas_id' => $this->encuesta->id,
            'users_id' => auth()->id(),
        ]);

        // Guardar el ID del dato_trabajador en la sesión para usarlo más tarde
        Session::put('dato_trabajador_id', $datoTrabajador->id);

        // Ir al siguiente paso (cuestionarios)
        $this->currentStep++;
    }

    private function calcularAvance()
    {
        // Obtener el número total de encuestas
        $totalEncuestas = $this->encuesta->NumeroEncuestas;
    
        // Obtener el número de respuestas guardadas en la base de datos
        $respuestasGuardadas = Respuesta::whereHas('datoTrabajador', function ($query) {
            $query->where('encuestas_id', $this->encuesta->id);
        })->count();
    
        // Obtener el número de respuestas en progreso
        $respuestasEnProgreso = count(array_filter($this->respuestas, function ($respuesta) {
            return !is_null($respuesta);
        }));
    
        // Calcular el avance
        if ($totalEncuestas > 0) {
            $avance = (($respuestasGuardadas + $respuestasEnProgreso) / $totalEncuestas) * 100;
        } else {
            $avance = 0; // Evitar división por cero
        }
    
        return round($avance, 2); // Redondear a 2 decimales
    }

    public function mount($key)
    {
        // Cargar la encuesta
        $this->encuesta = Encuesta::where('Clave', $key)->firstOrFail();
    
        // Obtener los IDs de los cuestionarios seleccionados
        $cuestionariosIds = $this->encuesta->cuestionarios->pluck('id')->toArray();
    
        // Asignar el cuestionarioId (asumiendo que el primer cuestionario es el 1)
        $this->cuestionarioId = $cuestionariosIds[0] ?? null;
    
        // Cargar las preguntas de los cuestionarios seleccionados
        $this->preguntas = PreguntaBase::whereIn('cuestionarios_id', $cuestionariosIds)->get();
    
        // Recuperar respuestas de la sesión si existen
        $this->respuestas = Session::get('respuestas_' . $this->encuesta->id, []);

         // Obtener los departamentos desde la base de datos
        $this->departamentos = Departamento::all(); 

        $this->calcularAvance();
    }

    public function updatedRespuestas($value, $key)
    {
        // Guardar las respuestas en la sesión
        Session::put('respuestas_' . $this->encuesta->id, $this->respuestas);
    
        // Recalcular el avance
        $this->avance = $this->calcularAvance();
    
        // Lógica adicional para mostrar/ocultar secciones (solo para cuestionario 1)
        if ($this->cuestionarioId == 1) {
            // Obtener las preguntas de la Sección I
            $seccionI = $this->preguntas
                ->where('Seccion', 'Acontecimiento traumático severo')
                ->pluck('id')
                ->toArray();
    
            // Filtrar las respuestas de la Sección I
            $respuestasSeccionI = array_intersect_key($this->respuestas, array_flip($seccionI));
    
            // Mostrar secciones adicionales si alguna respuesta en la Sección I es "Sí"
            $this->mostrarSeccionesAdicionales = in_array(1, $respuestasSeccionI);
    
            // Determinar si el trabajador requiere atención clínica
            if ($this->mostrarSeccionesAdicionales) {
                // Obtener las preguntas de las secciones II, III y IV
                $seccionII = $this->preguntas
                    ->where('Seccion', 'Recuerdos persistentes sobre el acontecimiento')
                    ->pluck('id')
                    ->toArray();
    
                $seccionIII = $this->preguntas
                    ->where('Seccion', 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento')
                    ->pluck('id')
                    ->toArray();
    
                $seccionIV = $this->preguntas
                    ->where('Seccion', 'Afectación')
                    ->pluck('id')
                    ->toArray();
    
                // Filtrar las respuestas de las secciones II, III y IV
                $respuestasSeccionII = array_intersect_key($this->respuestas, array_flip($seccionII));
                $respuestasSeccionIII = array_intersect_key($this->respuestas, array_flip($seccionIII));
                $respuestasSeccionIV = array_intersect_key($this->respuestas, array_flip($seccionIV));
    
                // Determinar si el trabajador requiere atención clínica
                $requiereAtencionClinica = in_array(1, $respuestasSeccionII) || // Al menos una respuesta "Sí" en Sección II
                    count(array_filter($respuestasSeccionIII, fn($respuesta) => $respuesta == 1)) >= 3 || // Tres o más respuestas "Sí" en Sección III
                    count(array_filter($respuestasSeccionIV, fn($respuesta) => $respuesta == 1)) >= 2; // Dos o más respuestas "Sí" en Sección IV
    
                // Guardar el resultado para usarlo en el envío
                $this->requiereAtencionClinica = $requiereAtencionClinica;
            }
        }
    }

    public function submit()
    {
        // Validar que todas las respuestas estén completas
        $this->validate([
            'respuestas.*' => 'required|in:0,1,2,3,4', // Validar respuestas del cuestionario
            'atencionClientes' => 'required_if:cuestionarioId,2|in:0,1', // Validar pregunta clave del cuestionario 2
            'esJefe' => 'required_if:cuestionarioId,2|in:0,1', // Validar pregunta clave del cuestionario 2
        ]);

            // Validar los datos personales
        $this->validate([
            'nombre' => 'nullable|string|max:45',
            'apellidoPaterno' => 'nullable|string|max:45',
            'apellidoMaterno' => 'nullable|string|max:45',
            'sexo' => 'nullable|string|max:45',
            'edad' => 'nullable|string|max:45',
            'estadoCivil' => 'nullable|string|max:45',
            'estudios' => 'nullable|string|max:45',
            'ocupacion' => 'nullable|string|max:45',
            'departamento' => 'nullable|string|max:45',
            'tipoPuesto' => 'nullable|string|max:45',
            'contratacion' => 'nullable|string|max:45',
            'tipoPersonal' => 'nullable|string|max:45',
            'jornadaTrabajo' => 'nullable|string|max:45',
            'rotacionTurnos' => 'nullable|string|max:45',
            'experiencia' => 'nullable|string|max:45',
            'tiempoPuesto' => 'nullable|string|max:45',
        ]);
        

        // Calcular el avance
        $this->avance = $this->calcularAvance();

        // Guardar las respuestas en la base de datos
        // Guardar los datos del trabajador en la tabla dato_trabajadores
        $datoTrabajador = DatoTrabajador::create([
            'Nombre' => $this->nombre,
            'ApellidoPaterno' => $this->apellidoPaterno,
            'ApellidoMaterno' => $this->apellidoMaterno,
            'Sexo' => $this->sexo,
            'Edad' => $this->edad,
            'EstadoCivil' => $this->estadoCivil,
            'Estudios' => $this->estudios,
            'Ocupacion' => $this->ocupacion,
            'Departamento' => $this->departamento,
            'TipoPuesto' => $this->tipoPuesto,
            'Contratacion' => $this->contratacion,
            'TipoPersonal' => $this->tipoPersonal,
            'JornadaTrabajo' => $this->jornadaTrabajo,
            'RotacionTurnos' => $this->rotacionTurnos,
            'Experiencia' => $this->experiencia,
            'TiempoPuesto' => $this->tiempoPuesto,
            'Avance' => $this->avance,
            'encuestas_id' => $this->encuesta->id, // Relación con la encuesta
            'users_id' => auth()->id(), // Relación con el usuario autenticado
        ]);

        foreach ($this->respuestas as $preguntaId => $respuesta) {
            if (!PreguntaBase::where('id', $preguntaId)->exists()) {
                continue;
            }
        
            Respuesta::create([
                'ValorRespuesta' => $respuesta,
                'preguntasbases_id' => $preguntaId,
                'dato_trabajadores_id' => $datoTrabajador->id, // Asegúrate de que $datoTrabajador->id tenga un valor
            ]);
        }

        // Incrementar el contador de encuestas contestadas
        $this->encuesta->increment('EncuestasContestadas');

        // Calcular la calificación final (solo para cuestionario 2)
        if ($this->cuestionarioId == 2) {
            $calificacionFinal = $this->calcularCalificacionFinal();
            $nivelRiesgo = $this->determinarNivelRiesgo($calificacionFinal);

            // Guardar la calificación y el nivel de riesgo
            $trabajadorEncuesta->update([
                'calificacion_final' => $calificacionFinal,
                'nivel_riesgo' => $nivelRiesgo,
            ]);
        }

        // Calcular la calificación final (solo para cuestionario 3)
        if ($this->encuesta->cuestionarios->contains(3)) {
            $calificacionFinal = $this->calcularCalificacionFinalCuestionario3();
            $nivelRiesgoFinal = $this->determinarNivelRiesgoFinal($calificacionFinal);

            // Calcular puntuaciones por categoría y dominio
            $categorias = ['Ambiente de trabajo', 'Factores propios de la actividad', 'Organización del tiempo de trabajo', 'Liderazgo y relaciones en el trabajo', 'Entorno organizacional'];
            $dominios = ['Condiciones en el ambiente de trabajo', 'Carga de trabajo', 'Falta de control sobre el trabajo', 'Jornada de trabajo', 'Interferencia en la relación trabajo-familia', 'Liderazgo', 'Relaciones en el trabajo', 'Violencia', 'Reconocimiento del desempeño', 'Insuficiente sentido de pertenencia e, inestabilidad'];

            $resultadosCategorias = [];
            foreach ($categorias as $categoria) {
                $puntajeCategoria = $this->calcularPuntuacionPorCategoria($categoria);
                $nivelRiesgoCategoria = $this->determinarNivelRiesgoCategoria($puntajeCategoria, $categoria);
                $resultadosCategorias[$categoria] = $nivelRiesgoCategoria;
            }

            $resultadosDominios = [];
            foreach ($dominios as $dominio) {
                $puntajeDominio = $this->calcularPuntuacionPorDominio($dominio);
                $nivelRiesgoDominio = $this->determinarNivelRiesgoDominio($puntajeDominio, $dominio);
                $resultadosDominios[$dominio] = $nivelRiesgoDominio;
            }

            // Guardar resultados
            $datoTrabajador->update([
                'calificacion_final' => $calificacionFinal,
                'nivel_riesgo_final' => $nivelRiesgoFinal,
                'resultados_categorias' => json_encode($resultadosCategorias),
                'resultados_dominios' => json_encode($resultadosDominios),
            ]);

            // Determinar acciones
            $acciones = $this->accionesSegunNivelRiesgo($nivelRiesgoFinal);
        }

        // Limpiar las respuestas de la sesión después de enviar
        Session::forget('respuestas_' . $this->encuesta->id);

        // Redirigir a la página de agradecimiento
        return redirect()->route('survey.thankyou')->with('requiereAtencion', $this->requiereAtencionClinica ?? false);
    }

    public function nextStep()
    {
        if ($this->currentStep == 1 && $this->cuestionarioId == 1) {
            // Verificar si se deben mostrar las secciones adicionales
            $seccionI = $this->preguntas
                ->where('Seccion', 'Acontecimiento traumático severo')
                ->pluck('id')
                ->toArray();
    
            $respuestasSeccionI = array_intersect_key($this->respuestas, array_flip($seccionI));
    
            $this->mostrarSeccionesAdicionales = in_array(1, $respuestasSeccionI);
    
            if (!$this->mostrarSeccionesAdicionales) {
                // Saltar directamente al siguiente paso si no se necesitan las secciones adicionales
                $this->currentStep = 3; // Ajusta este valor según tu flujo de pasos
                return;
            }
        }
    
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    private function calcularCalificacionFinal()
    {
        $puntaje = 0;

        foreach ($this->respuestas as $preguntaId => $respuesta) {
            $pregunta = PreguntaBase::find($preguntaId);

            // Aplicar la lógica de calificación según el cuestionario 2
            if (in_array($preguntaId, range(18, 33))) {
                $puntaje += $respuesta; // Siempre=0, Casi siempre=1, etc.
            } elseif (in_array($preguntaId, array_merge(range(1, 17), range(34, 46)))) {
                $puntaje += (4 - $respuesta); // Siempre=4, Casi siempre=3, etc.
            }
        }

        return $puntaje;
    }

    private function calcularCalificacionFinalCuestionario3()
    {
        $puntaje = 0;

        // Preguntas con respuestas invertidas (0=Siempre, 4=Nunca)
        $preguntasInvertidas = [2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 29, 54, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72];

        foreach ($this->respuestas as $preguntaId => $respuesta) {
            if (in_array($preguntaId, $preguntasInvertidas)) {
                // Invertir la respuesta: 0=4, 1=3, 2=2, 3=1, 4=0
                $puntaje += (4 - $respuesta);
            } else {
                // Respuesta normal: 0=0, 1=1, 2=2, 3=3, 4=4
                $puntaje += $respuesta;
            }
        }

        return $puntaje;
    }

    private function determinarNivelRiesgoFinal($calificacionFinal)
    {
        if ($calificacionFinal < 50) {
            return 'Nulo o despreciable';
        } elseif ($calificacionFinal >= 50 && $calificacionFinal < 75) {
            return 'Bajo';
        } elseif ($calificacionFinal >= 75 && $calificacionFinal < 99) {
            return 'Medio';
        } elseif ($calificacionFinal >= 99 && $calificacionFinal < 140) {
            return 'Alto';
        } else {
            return 'Muy alto';
        }
    }

    private function calcularPuntuacionPorCategoria($categoria)
    {
        $puntaje = 0;

        // Preguntas por categoría
        $preguntasCategoria = $this->preguntas->where('Categoria', $categoria)->pluck('id')->toArray();

        foreach ($this->respuestas as $preguntaId => $respuesta) {
            if (in_array($preguntaId, $preguntasCategoria)) {
                // Verificar si la pregunta tiene respuestas invertidas
                $preguntasInvertidas = [2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 29, 54, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72];

                if (in_array($preguntaId, $preguntasInvertidas)) {
                    $puntaje += (4 - $respuesta);
                } else {
                    $puntaje += $respuesta;
                }
            }
        }

        return $puntaje;
    }

    private function determinarNivelRiesgoCategoria($puntaje, $categoria)
    {
        $rangos = [
            'Ambiente de trabajo' => ['Nulo o despreciable' => 5, 'Bajo' => 9, 'Medio' => 11, 'Alto' => 14],
            'Factores propios de la actividad' => ['Nulo o despreciable' => 15, 'Bajo' => 30, 'Medio' => 45, 'Alto' => 60],
            'Organización del tiempo de trabajo' => ['Nulo o despreciable' => 5, 'Bajo' => 7, 'Medio' => 10, 'Alto' => 13],
            'Liderazgo y relaciones en el trabajo' => ['Nulo o despreciable' => 14, 'Bajo' => 29, 'Medio' => 42, 'Alto' => 58],
            'Entorno organizacional' => ['Nulo o despreciable' => 10, 'Bajo' => 14, 'Medio' => 18, 'Alto' => 23],
        ];

        if ($puntaje < $rangos[$categoria]['Nulo o despreciable']) {
            return 'Nulo o despreciable';
        } elseif ($puntaje < $rangos[$categoria]['Bajo']) {
            return 'Bajo';
        } elseif ($puntaje < $rangos[$categoria]['Medio']) {
            return 'Medio';
        } elseif ($puntaje < $rangos[$categoria]['Alto']) {
            return 'Alto';
        } else {
            return 'Muy alto';
        }
    }

    private function calcularPuntuacionPorDominio($dominio)
    {
        $puntaje = 0;

        // Preguntas por dominio
        $preguntasDominio = $this->preguntas->where('Dominio', $dominio)->pluck('id')->toArray();

        foreach ($this->respuestas as $preguntaId => $respuesta) {
            if (in_array($preguntaId, $preguntasDominio)) {
                // Verificar si la pregunta tiene respuestas invertidas
                $preguntasInvertidas = [2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 29, 54, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72];

                if (in_array($preguntaId, $preguntasInvertidas)) {
                    $puntaje += (4 - $respuesta);
                } else {
                    $puntaje += $respuesta;
                }
            }
        }

        return $puntaje;
    }

    private function determinarNivelRiesgoDominio($puntaje, $dominio)
    {
        $rangos = [
            'Condiciones en el ambiente de trabajo' => ['Nulo o despreciable' => 5, 'Bajo' => 9, 'Medio' => 11, 'Alto' => 14],
            'Carga de trabajo' => ['Nulo o despreciable' => 15, 'Bajo' => 21, 'Medio' => 27, 'Alto' => 37],
            'Falta de control sobre el trabajo' => ['Nulo o despreciable' => 11, 'Bajo' => 16, 'Medio' => 21, 'Alto' => 25],
            'Jornada de trabajo' => ['Nulo o despreciable' => 1, 'Bajo' => 2, 'Medio' => 4, 'Alto' => 6],
            'Interferencia en la relación trabajo-familia' => ['Nulo o despreciable' => 4, 'Bajo' => 6, 'Medio' => 8, 'Alto' => 10],
            'Liderazgo' => ['Nulo o despreciable' => 9, 'Bajo' => 12, 'Medio' => 16, 'Alto' => 20],
            'Relaciones en el trabajo' => ['Nulo o despreciable' => 10, 'Bajo' => 13, 'Medio' => 17, 'Alto' => 21],
            'Violencia' => ['Nulo o despreciable' => 7, 'Bajo' => 10, 'Medio' => 13, 'Alto' => 16],
            'Reconocimiento del desempeño' => ['Nulo o despreciable' => 6, 'Bajo' => 10, 'Medio' => 14, 'Alto' => 18],
            'Insuficiente sentido de pertenencia e, inestabilidad' => ['Nulo o despreciable' => 4, 'Bajo' => 6, 'Medio' => 8, 'Alto' => 10],
        ];

        if ($puntaje < $rangos[$dominio]['Nulo o despreciable']) {
            return 'Nulo o despreciable';
        } elseif ($puntaje < $rangos[$dominio]['Bajo']) {
            return 'Bajo';
        } elseif ($puntaje < $rangos[$dominio]['Medio']) {
            return 'Medio';
        } elseif ($puntaje < $rangos[$dominio]['Alto']) {
            return 'Alto';
        } else {
            return 'Muy alto';
        }
    }

    private function accionesSegunNivelRiesgo($nivelRiesgo)
    {
        switch ($nivelRiesgo) {
            case 'Muy alto':
                return 'Se requiere realizar el análisis de cada categoría y dominio para establecer las acciones de intervención apropiadas, mediante un Programa de intervención que deberá incluir evaluaciones específicas.';
            case 'Alto':
                return 'Se requiere realizar un análisis de cada categoría y dominio, de manera que se puedan determinar las acciones de intervención apropiadas a través de un Programa de intervención.';
            case 'Medio':
                return 'Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial.';
            case 'Bajo':
                return 'Es necesario una mayor difusión de la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial.';
            case 'Nulo o despreciable':
                return 'El riesgo resulta despreciable por lo que no se requiere medidas adicionales.';
            default:
                return 'Nivel de riesgo no reconocido.';
        }
    }

    private function determinarNivelRiesgo($calificacionFinal)
    {
        if ($calificacionFinal < 20) {
            return 'Nulo o despreciable';
        } elseif ($calificacionFinal >= 20 && $calificacionFinal < 45) {
            return 'Bajo';
        } elseif ($calificacionFinal >= 45 && $calificacionFinal < 70) {
            return 'Medio';
        } elseif ($calificacionFinal >= 70 && $calificacionFinal < 90) {
            return 'Alto';
        } else {
            return 'Muy alto';
        }
    }

    public function render()
    {
        return view('livewire.dx035.cuestionario-para-responder.responder-cuestionario-uno')
            ->layout('layouts.cuestionariosdx035');
    }
}