<?php

namespace App\Models\Encuestas360;

use App\Models\PortalRH\Empres;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\EmpresaSucursal;
use App\Models\PortalRH\EmpresSucursal;
use App\Models\PortalRH\RegistPatronal;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'calificador_id',
        'calificado_id',
        'relaciones_id',
        '360_encuestas_id',
        'realizada',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'realizada' => 'boolean',
    ];

    public function calificador()
    {
        return $this->belongsTo(User::class);
    }

    public function calificado()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function relacion()
    {
        return $this->belongsTo(Relacion::class, 'relaciones_id');
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta360::class, '360_encuestas_id', 'id');
    }


    public function empresaSucursal()
    {
        return $this->belongsTo(EmpresaSucursal::class, 'empresa_sucursal_id');
    }

    // public function sucursal()
    // {
    //     return $this->belongsTo()
    // } 

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function empresa()
{
    return $this->belongsTo(Empresa::class, 'empresa_id');
}

    public function respuestasUsuario()
    {
        return $this->hasMany(RespuestaUsuario::class, 'asignaciones_id');
    }

    public function respuestas()
    {
        return $this->hasMany(RespuestaUsuario::class, 'asignaciones_id');
    }
}


