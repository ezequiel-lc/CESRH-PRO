<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipodocument; // Importa el modelo
use App\Models\User;

class Documento extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'becarios';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'archivo', 
        'fecha_subida',
        'status',
        'numero',
        'original',
        'comentarios',
        'tipodocumento_id'
    ];

    //alcanze con el modelo User
    public function tipoDoc()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withPivot('documento_id', 'user_id', 'status');
    }
}
