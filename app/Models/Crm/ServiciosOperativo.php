<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosOperativo extends Model
{
    use HasFactory;

    protected $table = 'servicios_operativos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'head_asesor', 'correo', 'telefono', 'num_cotizacion', 'cotizacion_emitida', 'cotizacion_valida_hasta', 'levantamientoPed_id'];

    public function levantamientospedidos()
    {
        return $this->belongsTO(HeadLevantamientosPedido::class);
    }

    public function informacionesoperativos()
    {
        return $this->belongsTO(InformacionesOperativo::class);
    }

    public function aprobadaoperativos()
    {
        return $this->hasMany(AprobadaOperativo::class);
    }
}