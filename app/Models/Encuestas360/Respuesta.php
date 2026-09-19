<?php

namespace App\Models\Encuestas360;

use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = '360_respuestas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'texto', 'puntuacion', 'preguntas_id','empresa_id', 'sucursal_id'];
    
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'preguntas_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function respuestasUsuarios()
    {
        return $this->hasMany(RespuestaUsuario::class, 'respuestas_id');
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'preguntas_id');
    }

    public function sucursal()
{
    return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id');
}

}
