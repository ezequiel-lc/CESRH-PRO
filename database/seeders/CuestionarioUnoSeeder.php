<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dx035\PreguntaBase;

class CuestionarioUnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas_bases = [
            ['Pregunta' => '¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Asaltos?', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Actos violentos que derivaron en lesiones graves?', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Secuestro?', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Amenazas?, o', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas', 'Seccion' => 'Acontecimiento traumático severo', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares?', 'Seccion' => 'Recuerdos persistentes sobre el acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?', 'Seccion' => 'Recuerdos persistentes sobre el acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido dificultad para recordar alguna parte importante del evento?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha disminuido su interés en sus actividades cotidianas?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Se ha sentido usted alejado o distante de los demás?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha notado que tiene dificultad para expresar sus sentimientos?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?', 'Seccion' => 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido usted dificultades para dormir?', 'Seccion' => 'Afectación (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha estado particularmente irritable o le han dado arranques de coraje?', 'Seccion' => 'Afectación (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha tenido dificultad para concentrarse?', 'Seccion' => 'Afectación (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Ha estado nervioso o constantemente en alerta?', 'Seccion' => 'Afectación (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
            ['Pregunta' => '¿Se ha sobresaltado fácilmente por cualquier cosa?', 'Seccion' => 'Afectación (durante el último mes)', 'Puntuacion'=>0,'cuestionarios_id'=>1],
        ];

        foreach ($preguntas_bases as $pregunta_base) {
            PreguntaBase::create($pregunta_base);
        }
    }
}
