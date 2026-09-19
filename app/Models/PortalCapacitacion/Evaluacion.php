<?php

namespace App\Models\PortalCapacitacion;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    // Especificar la tabla en la base de datos
    protected $table = 'evaluaciones';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 
        'fecha_evaluacion', 
        'criterio',
        'calificacion_desempeno', 
        'comentarios', 
        'recomendaciones', 
        'tiempo_puesto_actual', 
        'users_id',
        'perfiles_puestos_id',
    ];
    
    // Relación inversa con usuarios (pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relación muchos a muchos con perfiles_puestos
    public function perfilesPuestos()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'evaluacion_perfil_puesto', 'evaluaciones_id', 'perfiles_puestos_id'); // Modelo relacionado
    }
}
