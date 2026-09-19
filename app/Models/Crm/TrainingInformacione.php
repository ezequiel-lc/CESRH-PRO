<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingInformacione extends Model
{
    use HasFactory;

    protected $table = 'training_informaciones';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'id_servicio', 'nombre', 'modalidad', 'ubicacion', 'curso', 'duracionTotalHoras', 'numSesiones', 'cupoMaxPerson', 'grupos', 'precioPorGrupo', 'descuentoEspecial', 'precioConDescuento', 'precioSinIVa'];

    public function trainingservicio()
    {
        return $this->hasMany(TrainingServicio::class);
    }
}
