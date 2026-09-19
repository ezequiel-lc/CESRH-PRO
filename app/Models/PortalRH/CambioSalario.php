<?php

namespace App\Models\PortalRH;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioSalario extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'cambio_salarios';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'fecha_cambio', 
        'salario_anterior',
        'salario_nuevo',
        'motivo',
        'documento',
        'observaciones'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cambio_salario', 'cambio_salario_id', 'user_id')->withTimestamps();
    }

}
