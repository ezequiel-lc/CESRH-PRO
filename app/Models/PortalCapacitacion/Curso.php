<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 'cursos';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id','empresa_id', 'sucursal_id', 'nombre', 'horas', 'precio', 'tipoestatus', 'tematicas_id', 'modalidad'];

    // Relación inversa (pertenece a una temática)
    public function tematicas()
    {
        return $this->belongsToMany(Tematica::class, 'tematicas_id');
    }

     // Relación uno a muchos con empresas
     public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresas_id');
    }
 
     // Relación uno a muchos con sucursales 
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursales_id');
    }
}

