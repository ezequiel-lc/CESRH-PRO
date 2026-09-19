<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprobadaTraining extends Model
{
    use HasFactory;
    protected $table = "aprobada_trainings";

    protected $fillable = [
        'id', 'fecha_aprobacion', 'email_enviado','training_servicios_id',
    ];

    public function trainningservicio()
    {
        return $this->belongsTo(TrainingServicio::class);
    }
}
