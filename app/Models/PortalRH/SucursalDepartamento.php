<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalDepartamento extends Model
{
    use HasFactory;

    protected $table = 'departamento_sucursal';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'sucursal_id', 
        'departamento_id',
        'status',
    ];
}
