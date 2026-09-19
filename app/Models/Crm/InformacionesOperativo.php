<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionesOperativo extends Model
{
    use HasFactory;

    protected $table = 'informaciones_operativos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'numeroCotizacion', 'servicio', 'habitacion', 'puesto', 'cantidad', 'sueldoMensual', 'comision','pu_por_vacante','precio_sin_iva'];

    public function serviciosoperativo()
    {
        return $this->hasMany(ServiciosOperativo::class);
    }
}
