<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajadorEncuesta extends Model
{
    use HasFactory;

    protected $table='trabajadores_encuestas';

    protected $fillable = [
        'Avance',
        'encuesta_id',
        'fecha_fin_encuesta',
        'users_id',
    ];

    // Relación con la encuesta
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuesta_id');
    }

    // Relación con las respuestas
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'trabajadores_encuestas_id');
    }
}