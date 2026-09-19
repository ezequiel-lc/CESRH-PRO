<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortalCapacitacion\Curso;
use App\Models\PortalCapacitacion\Evidencia;
use App\Models\User;

class GrupocursoCapacitacion extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 'grupocursos_capacitaciones';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = [
        'id',
        'empresa_id',
        'sucursal_id',
        'nombreGrupo',
        'nombreCapacitacion',
        'fechaIni',
        'fechaFin',
        'cursos_id',
        'objetivo_capacitacion',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    // Relación con la tabla Participantes (uno a muchos)
    public function participantes()
    {
        return $this->hasMany(Participante::class, 'grupocursos_capacitaciones_id');
    }

    // Relación con la tabla Escaneardc3s (uno a muchos)
    public function escaneos()
    {
        return $this->hasMany(Escaneardc::class, 'grupocursos_capacitaciones_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id'); // Cambio aquí
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id'); // Cambio aquí
    }

    public function evidencias()
    {
        return $this->belongsToMany(Evidencia::class, 'evidencia_cap_individual', 'caps_individuales_id', 'evidencias_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 
            'participante_user',
            'users_id', 
            'grupocursos_capacitaciones_id');
    }

}
