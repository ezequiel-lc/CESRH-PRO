<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    use HasFactory;

    protected $fillable = ['Nombre', 'giasreferencias_id'];

    // Relación con PreguntaBase
    public function preguntasBases()
    {
        return $this->hasMany(PreguntaBase::class, 'cuestionarios_id');
    }

    // Relación con GiaReferencia
    public function giaReferencia()
    {
        return $this->belongsTo(GiaReferencia::class, 'giasreferencias_id');
    }

    // Relación con Encuesta a través de la tabla pivote encuesta_cuestionario
    public function encuestas()
    {
        return $this->belongsToMany(Encuesta::class, 'encuesta_cuestionario', 'cuestionario_id', 'encuesta_id');
    }
}
