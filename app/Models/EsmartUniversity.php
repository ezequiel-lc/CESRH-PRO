<?php

namespace App\Models;

use App\Models\Crm\EsmartLevantamiento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsmartUniversity extends Model
{
    use HasFactory;

    protected $table = 'esmart_universities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_curso','participantes','departamentos_participan','puestos_participan','fecha_habilitada',
        'esmart_levantamientos_id','dc3_requieren','nuevo_existente','nuevo_curso','horas_nuevo','tipo_curso',
    ];

    public function esmarlevantamiento()
    {
        return $this->hasMany(EsmartLevantamiento::class);
    }
}
