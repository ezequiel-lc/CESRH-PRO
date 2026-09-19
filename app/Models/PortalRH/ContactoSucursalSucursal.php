<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoSucursalSucursal extends Model
{
    use HasFactory;

    protected $table = 'contacto_sucursal_sucursal';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'contacto_sucursal_id',
        'sucursal_id',
        'status',
    ];

    public function contactoSucursal()
    {
        return $this->belongsTo(ContactoSucursal::class, 'contacto_sucursal_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
