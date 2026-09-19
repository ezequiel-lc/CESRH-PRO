<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User

class Baja extends Model
{
    use HasFactory;
    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'bajas';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'fecha_baja', 
        'motivo_baja',
        'tipo_baja',
        'documento',
        'observaciones',
        'user_id',
    ];

    //alcanze con el modelo User
    public function user()
    {
        //una baja pertenece a user
        return $this->belongsTo(User::class);
    }
}
