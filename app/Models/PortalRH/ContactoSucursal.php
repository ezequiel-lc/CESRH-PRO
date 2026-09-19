<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoSucursal extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'contactos_sucursales';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'nomCont', 
        'apePCont',
        'apeMCont',
        'telefonoCont',
        'telefonoCont2',
        'correoCont',
        'correoCont2'
    ];

    public function sucursal()
    {
        return $this->belongsToMany(Sucursal::class);
    }
}
