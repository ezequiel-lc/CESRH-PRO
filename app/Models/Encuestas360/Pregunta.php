<?php

namespace App\Models\Encuestas360;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'texto', 'descripcion', 'encuestas_id'];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'preguntas_id');
    }

    public function encpres()
    {
        return $this->hasMany(Encpre::class, 'preguntas_id');
    }

    public function encuesta()
{
    return $this->belongsTo(Encuesta360::class, 'encuestas_id');
}


    
}
