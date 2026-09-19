<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaBase extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'preguntas_bases';

    protected $fillable = [
        'Pregunta','Seccion','Categoria', 'Dominio', 'Dimension',
        'Puntuacion', 'cuestionarios_id'
    ];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'preguntasbases_id');
    }

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class, 'cuestionarios_id');
    }
}
