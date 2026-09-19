<?php

namespace App\Models\PortalRH;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retardo extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'retardos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'fecha', 
        'hora_entrada_programada',
        'hora_entrada_real',
        'minutos_retardo',
        'motivo',
        'status'
    ];


    public function users()
    {
        //un becario pertenece a un user
        return $this->belongsToMany(User::class, 'user_retardo', 'retardo_id', 'user_id')->withTimestamps();
    }
}
