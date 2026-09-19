<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Participante extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 'participantes';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = [
        'id',
        'grupocursos_capacitaciones_id',
        'status',
    ];

    // Relación con la tabla grupocursos_capacitaciones (muchos a uno)
    public function grupocurso()
    {
        return $this->belongsTo(GrupocursoCapacitacion::class, 'grupocursos_capacitaciones_id');
    }

    // Relación con la tabla evidencias (muchos a muchos)
    public function evidencias()
    {
        return $this->belongsToMany(
            Evidencia::class, 
            'participante_evidencia',
            'participantes_id',
            'evidencias_id'
        );
    }

    // Relación con la tabla users (muchos a muchos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'participante_user', 'participantes_id', 'users_id');
    }

    public function capacitacion()
    {
        return $this->belongsTo(GrupocursoCapacitacion::class, 'grupocursos_capacitaciones_id');
    }

}

