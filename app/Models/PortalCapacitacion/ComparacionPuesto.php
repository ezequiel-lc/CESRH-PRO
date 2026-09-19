<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparacionPuesto extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 'comparaciones_puestos';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = [
        'id',
        'fecha_comparacion',
        'competencias_requeridas',
        'nivel_actual',
        'nivel_nuevo',
        'diferencia',
        'puesto_nuevo',
        'perfiles_puestos_id',
    ];

    // Relación con la tabla perfiles_puestos (muchos a uno)
    public function perfilPuesto()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'perfiles_puestos_id');
    }

    public function puestoNuevo()
    {
        return $this->belongsTo(PerfilPuesto::class, 'puesto_nuevo');
    }
}
