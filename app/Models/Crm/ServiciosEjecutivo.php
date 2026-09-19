<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosEjecutivo extends Model
{
    use HasFactory;

    protected $table = 'servicio_ejecutivos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 'head_asesor', 'correo', 'telefono', 
        'num_cotizacion', 'cotizacion_emitida', 
        'cotizacion_valida_hasta', 'informaciones_ejecutivos_id',
    ];

    public function ejectcotizacionesaprobadas()
    {
        return $this->hasMany(EjectCotizacionesAprobada::class);
    }

    public function informacionejecutivos()
    {
        return $this->belongsTo(InformacionesEjecutivo::class);
    }

    public function levantamientopedidos()
    {
        return $this->belongsTo(HeadLevantamientosPedido::class);
    }
}