<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingServicio extends Model
{
    use HasFactory;

    protected $table = 'training_servicios';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'asesor', 'asesor_correo', 'asesor_telefono', 'numero_cotizacion', 'cotizacion_emitida', 'fin_cotizacion_valida', 'levantrainin_id'];

    public function TrainingLevantamiento()
    {
        return $this->belongsTo(TrainingLevantamiento::class);
    }

    public function aprobadatrainings()
    {
        return $this->hasMany(AprobadaTraining::class);
    }

    public function traininginformaciones()
    {
        return $this->belongsTo(TrainingInformacione::class);
    }
}
 