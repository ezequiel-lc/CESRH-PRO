<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosEspecializado extends Model
{
    use HasFactory;

    protected $table = 'servicios_especializados';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 'head_asesor', 'correo', 'telefono', 'num_cotizacion', 
        'cotizacion_emitida', 'cotizacion_valida_hasta', 'levantamientoPed_id', 
    ];


    public function aprobadoespecializados()
    {
        return $this->hasMany(AprobadoEspecializado::class);
    }

    public function informacionesespecializados()
    {
        return $this->belongsTo(InformacionesEspecializado::class);
    }

    public function levantamientopedidos()
    {
        return $this->belongsTo(HeadLevantamientosPedido::class);
    }
}