<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadoEspecializado extends Model
{
    use HasFactory;
    protected $table = "servicios_especializados";

    protected $primaryKey = 'id';

    protected $fillable = [
       'id', 'fecha_aprobacion', 'correo_enviado', 'servicios_especializados_id'
    ];
    
    public function serviciosespecializado()
    {
        return $this->belongsTo(ServiciosEspecializado::class);
    }
}
