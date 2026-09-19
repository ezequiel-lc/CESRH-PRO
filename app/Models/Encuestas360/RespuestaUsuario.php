<?php

namespace App\Models\Encuestas360;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaUsuario extends Model
{
    use HasFactory;

    protected $table = 'respuestas_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['respuesta360_id', 'asignaciones_id'];
    
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignaciones_id');
    }

    public function respuesta360() // Cambia el nombre del método a 'respuesta360'
    {
        return $this->belongsTo(Respuesta::class, 'respuesta360_id');
    }

    
    
}
