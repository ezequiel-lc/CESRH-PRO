<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentanteTraSucursal extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'representante_tra_sucursal';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'RTnombre', 
        'RTapePaterno',
        'RTapeMaterno',
        'sucursal_id'
    ];


    //alcanze con el modelo User
    public function sucursales()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
