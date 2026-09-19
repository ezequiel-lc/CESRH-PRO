<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo

class InfonavitCredito extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'infonavit_creditos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'tipo_movimiento', 
        'numero_credito',
        'fecha_movimiento',
        'tipo_descuento',
        'valor_descuento',
        'user_id'
    ];

    //alcanze con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
