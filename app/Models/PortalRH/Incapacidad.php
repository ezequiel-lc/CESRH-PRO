<?php

namespace App\Models\PortalRH;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'incapacidades';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'tipo',
        'motivo',
        'fecha_inicio', 
        'fecha_final',
        'documento',
        'status',
        'observaciones'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_incapacidad', 'incapacidad_id', 'user_id')->withTimestamps();
    }
}
