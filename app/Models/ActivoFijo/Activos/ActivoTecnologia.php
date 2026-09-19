<?php

namespace App\Models\ActivoFijo\Activos;

use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Foto;
use App\Models\ActivoFijo\Notatecno;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoTecnologia extends Model
{
    use HasFactory;
    protected $table = 'activos_tecnologias';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'num_serie',
        'num_activo',
        'ubicacion_fisica',
        'fecha_adquisicion',
        'fecha_baja',
        'tipo_activo_id',
        'precio_adquisicion',
        'aniosestimado_id',
        'foto1',
        'foto2',
        'foto3',
        'empresa_id',
        'sucursal_id',
        'status'
    ];

    public function tipoactivo()
    {
        return $this->belongsTo(Tipoactivo::class, 'tipo_activo_id', 'id');
    }

    public function anioEstimado()
    {
        return $this->belongsTo(AnioEstimado::class, 'aniosestimado_id', 'id');
    }

    //Relacion muchos a muchos
    public function notastecnologias()
    {
        return $this->belongsToMany(Notatecno::class, 'notastecnologia_activos_tecnologia', 'activos_t_id', 'notast_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'activos_tecnologia_user', 'activos_tecnologias_id', 'user_id')
                ->withPivot('fecha_asignacion', 'fecha_devolucion', 'observaciones', 'status', 'foto1', 'foto2', 'foto3')
                ->withTimestamps();
    }
    
}
