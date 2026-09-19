<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 'tematicas';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 'empresa_id', 'sucursal_id','nombre'];

    // Relación uno a muchos con cursos
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

     // Relación uno a muchos con empresas
     public function empresa()
     {
         return $this->belongsTo(Empresa::class);
     }
 
     // Relación uno a muchos con sucursales 
     public function sucursal()
     {
         return $this->belongsTo(Sucursal::class);
     }
}
