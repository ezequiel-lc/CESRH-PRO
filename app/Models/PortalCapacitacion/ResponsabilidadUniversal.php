<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsabilidadUniversal extends Model
{
    use HasFactory;
    // Especificar la tabla en la base de datos
    protected $table = 'respons_univ';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id',
            'empresa_id',
            'sucursal_id', 
            'sistema',  
            'responsalidad',];

    // Relación muchos a muchos con perfiles_puestos
    public function perfiles_puestos()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'respon_univ_perfil_puesto', 'respons_univ_id', 'perfiles_puestos_id'); // Modelo relacionado
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
