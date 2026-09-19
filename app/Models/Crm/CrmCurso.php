<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCurso extends Model
{
    use HasFactory;

    protected $table = 'crm_cursos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'id_servicio', 'nombre', 'modalidad', 'ubicacion', 'curso', 'duracionTotalHoras', 'numSesiones', 'cupoMaxPerson', 'grupos', 'precioPorGrupo', 'descuentoEspecial', 'precioConDescuento', 'precioSinIVa'];

    public function traininglevantamiento()
    {
        return $this->belongsTo(TrainingLevantamiento::class);
    }
}
