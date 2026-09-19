<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User

class Puesto extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'puestos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'nombre_puesto'
    ];

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class)->withPivot('departamento_id', 'puesto_id');
    }

    public function becarios()
    {
        return $this->hasMany(Becario::class);
    }

    public function trabajador()
    {
        return $this->hasMany(Trabajador::class);
    }

    public function practicantes()
    {
        return $this->hasMany(Practicante::class);
    }

    public function instructores()
    {
        return $this->hasMany(Instructor::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
