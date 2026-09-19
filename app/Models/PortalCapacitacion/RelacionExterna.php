<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionExterna extends Model
{
    use HasFactory;
    // Especificar la tabla en la base de datos
    protected $table = 'relaciones_externas';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 
            'empresa_id',
            'sucursal_id',
            'nombre', 
            'razon_motivo', 
            'frecuencia'];

    // Relación muchos a muchos con perfiles_puestos
    public function perfiles_puestos()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'relacion_interna_perfil_puesto', 'relaciones_externas_id', 'perfiles_puestos_id'); // Modelo relacionado
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
