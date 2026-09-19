<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionesEspecializado extends Model
{
    use HasFactory;

    protected $table = 'informaciones_especializados';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'numero_cotizacion', 'servicio', 'ubicacion', 'puesto', 'cantidad', 'sueldomensual', 'comision','pu_por_vacante','precio_sin_iva'];

    public function serviciosEspecializado()
    {
        return $this->hasMany(ServiciosEspecializado::class);
    }
}
