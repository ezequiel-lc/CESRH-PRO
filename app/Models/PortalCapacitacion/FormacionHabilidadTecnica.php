<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormacionHabilidadTecnica extends Model
{
    use HasFactory;
    // Especificar la tabla en la base de datos
    protected $table = 'formaciones_tecnicas';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 
            'empresa_id',
            'sucursal_id',
            'descripcion', 
            'nivel'];

    // Relación muchos a muchos con perfiles_puestos
    public function perfiles_puestos()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'formacion_tecnica_perfil_puesto', 'perfiles_puestos_id', 'formaciones_tecnicas_id'); // Modelo relacionado
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