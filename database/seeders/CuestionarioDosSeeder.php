<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dx035\PreguntaBase;

class CuestionarioDosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas_bases = [
            ['Pregunta' => 'Me preocupa sufrir un accidente en mi trabajo', 'Categoria' => 'Ambiente de trabajo','Dominio'=>'Condiciones en el ambiente de trabajo','Dimension' => 'Condiciones peligrosas e inseguras','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo me exige hacer mucho esfuerzo físico', 'Categoria' => 'Ambiente de trabajo','Dominio'=>'Condiciones en el ambiente de trabajo','Dimension' => 'Condiciones deficientes e insalubres','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Considero que las actividades que realizo son peligrosas', 'Categoria' => 'Ambiente de trabajo','Dominio'=>'Condiciones en el ambiente de trabajo','Dimension' => 'Trabajos peligrosos','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas cuantitativas','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo exige que atienda varios asuntos al mismo tiempo', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas cuantitativas','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Por la cantidad de trabajo que tengo debo trabajar sin parar', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Ritmos de trabajo acelerado','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Considero que es necesario mantener un ritmo de trabajo acelerado', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Ritmos de trabajo acelerado','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo exige que esté muy concentrado', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Carga mental','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo requiere que memorice mucha información', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Carga mental','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Atiendo clientes o usuarios muy enojados', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas psicológicas emocionales','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas psicológicas emocionales','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Para hacer mi trabajo debo demostrar sentimientos distintos a los míos', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas psicológicas emocionales','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'En mi trabajo soy responsable de cosas de mucho valor', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas de alta responsabilidad','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Respondo ante mi jefe por los resultados de toda mi área de trabajo', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas de alta responsabilidad','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'En mi trabajo me dan órdenes contradictorias', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas contradictorias o inconsistentes','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Considero que en mi trabajo me piden hacer cosas innecesarias', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Carga de trabajo','Dimension' => 'Cargas contradictorias o inconsistentes','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Durante mi jornada de trabajo puedo tomar pausas cuando las necesito', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Falta de control y autonomía sobre el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Falta de control y autonomía sobre el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Puedo cambiar el orden de las actividades que realizo en mi trabajo', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Falta de control y autonomía sobre el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo permite que desarrolle nuevas habilidades', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Limitada o nula posibilidad de desarrollo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'En mi trabajo puedo aspirar a un mejor puesto', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Limitada o nula posibilidad de desarrollo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Me permiten asistir a capacitaciones relacionadas con mi trabajo', 'Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Limitada o inexistente capacitación','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Recibo capacitación útil para hacer mi trabajo','Categoria' => 'Factores propios de la actividad','Dominio'=>'Falta de control sobre el trabajo','Dimension' => 'Limitada o inexistente capacitación','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Trabajo horas extras más de tres veces a la semana','Categoria' => 'Organización del tiempo de trabajo','Dominio'=>'Jornada de trabajo','Dimension' => 'Jornadas de trabajo extensas','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mi trabajo me exige laborar en días de descanso, festivos o fines de semana','Categoria' => 'Organización del tiempo de trabajo','Dominio'=>'Jornada de trabajo','Dimension' => 'Jornadas de trabajo extensas','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales','Categoria' => 'Organización del tiempo de trabajo','Dominio'=>'Interferencia en la relación trabajo-familia','Dimension' => 'Influencia del trabajo fuera del centro laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Pienso en las actividades familiares o personales cuando estoy en mi trabajo','Categoria' => 'Organización del tiempo de trabajo','Dominio'=>'Interferencia en la relación trabajo-familia','Dimension' => 'Influencia de las responsabilidades familiares','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Me informan con claridad cuáles son mis funciones','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Liderazgo','Dimension' => 'Escasa claridad de funciones','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Me explican claramente los resultados que debo obtener en mi trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Liderazgo','Dimension' => 'Escasa claridad de funciones','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Me informan con quién puedo resolver problemas o asuntos de trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Liderazgo','Dimension' => 'Escasa claridad de funciones','Puntuacion'=>0,'cuestionarios_id'=>2],

            ['Pregunta' => 'Mi jefe tiene en cuenta mis puntos de vista y opiniones','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Liderazgo','Dimension' => 'Características del liderazgo','Puntuacion'=>0,'cuestionarios_id'=>2],


            ['Pregunta' => 'Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Liderazgo','Dimension' => 'Características del liderazgo','Puntuacion'=>0,'cuestionarios_id'=>2],



            ['Pregunta' => 'Puedo confiar en mis compañeros de trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Relaciones sociales en el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Cuando tenemos que realizar trabajo de equipo los compañeros colaboran','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Relaciones sociales en el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Mis compañeros de trabajo me ayudan cuando tengo dificultades','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Relaciones sociales en el trabajo','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Comunican tarde los asuntos de trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Deficiente relación con los colaboradores que supervisa','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Dificultan el logro de los resultados del trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Deficiente relación con los colaboradores que supervisa','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Ignoran las sugerencias para mejorar su trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Relaciones en el trabajo','Dimension' => 'Deficiente relación con los colaboradores que supervisa','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'En mi trabajo puedo expresarme libremente sin interrupciones','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Recibo críticas constantes a mi persona y/o trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
            ['Pregunta' => 'He presenciado actos de violencia en mi centro de trabajo','Categoria' => 'Liderazgo y relaciones en el trabajo','Dominio'=>'Violencia','Dimension' => 'Violencia laboral','Puntuacion'=>0,'cuestionarios_id'=>2],
        ];

        foreach ($preguntas_bases as $pregunta_base) {
            PreguntaBase::create($pregunta_base);
        }
    }
}
