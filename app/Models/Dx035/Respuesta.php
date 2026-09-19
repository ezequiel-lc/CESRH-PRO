<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'ValorRespuesta',
        'preguntasbases_id',
        'dato_trabajadores_id', // Asegúrate de que esté incluido
    ];

    public function preguntaBase()
    {
        return $this->belongsTo(PreguntaBase::class, 'preguntasbases_id');
    }

    public function datoTrabajador()
    {
        return $this->belongsTo(DatoTrabajador::class, 'dato_trabajadores_id');
    }
}
