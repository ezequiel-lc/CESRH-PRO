<?php

namespace App\Models\ActivoFijo\Activos;

use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoOficina extends Model
{
    use HasFactory;
    protected $table = 'activos_oficinas';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'numero_activo',
        'ubicacion_fisica',
        'tipo_activo_id',
        'fecha_adquisicion',
        'fecha_baja',
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
        return $this->belongsTo(Tipoactivo::class,'tipo_activo_id','id');
    }

    public function anioEstimado()
    {
        return $this->belongsTo(AnioEstimado::class, 'aniosestimado_id', 'id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'activos_tecnologia_user')
            ->withPivot('fecha_asignacion', 'fecha_devolucion', 'observaciones', 'status', 'foto1', 'foto2', 'foto3')
            ->withTimestamps();
    }
}
