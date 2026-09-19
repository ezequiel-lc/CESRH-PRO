<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsmartAprobada extends Model
{
    use HasFactory;

    protected $table = "esmart_aprobadas";

    protected $fillable = [
        'id', 'fecha_aprobacion', 'email_enviado','esmart_levantamientos_id',
    ];

    public function esmartlevantamiento()
    {
        return $this->belongsTo(EsmartLevantamiento::class);
    }
}
