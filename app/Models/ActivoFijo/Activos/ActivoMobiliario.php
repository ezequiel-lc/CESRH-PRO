<?php

namespace App\Models\ActivoFijo\Activos;

use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Foto;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoMobiliario extends Model
{
    use HasFactory;
    protected $table = 'activos_mobiliarios';

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
        'foto4',
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

    //Relaciones muchos a muchos
    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
    }
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'activos_mobiliario_user', 'activos_mobiliarios_id', 'user_id')
            ->withPivot('fecha_asignacion', 'fecha_devolucion', 'observaciones', 'status', 'foto1')
            ->withTimestamps();
    }
}
