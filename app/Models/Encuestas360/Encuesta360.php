<?php

namespace App\Models\Encuestas360;

use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta360 extends Model
{
    use HasFactory;
    protected $table = '360_encuestas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion', 'indicaciones', 'empresa_id', 'sucursal_id'];


    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id');
    }

    public function preguntas()
{
    return $this->hasMany(Pregunta::class, 'encuestas_id');
}



    
}
