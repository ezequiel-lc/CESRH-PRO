<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjectCotizacionesAprobada extends Model
{
    use HasFactory;

    protected $table = 'eject_cotizaciones_aprobadas';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'fecha_aprobacion', 'correo_enviado', 'servicios_ejecutivos_id'];

    public function serviciosejecutivo()
    {
        return $this->belongsTo(ServiciosEjecutivo::class);
    }
}