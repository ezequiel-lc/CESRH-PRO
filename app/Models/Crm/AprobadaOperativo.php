<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadaOperativo extends Model
{
    use HasFactory;

    protected $table = "aprobada_operativos";

    protected $fillable = [
        'id', 'fecha_aprobacion', 'email_enviado','servicios_operativos_id',
    ];

    public function serviciosoperativo()
    {
        return $this->belongsTo(ServiciosOperativo::class);
    }
}   
