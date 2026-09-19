<?php

namespace App\Models\PortalRH;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'incidencias';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'tipo_incidencia', 
        'fecha_inicio',
        'fecha_final'
    ];

    // Definir relación muchos a muchos con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_incidencia', 'incidencia_id', 'user_id')->withTimestamps();
    }
}
