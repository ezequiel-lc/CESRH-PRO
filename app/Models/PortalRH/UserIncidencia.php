<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIncidencia extends Model
{
    use HasFactory;

    protected $table = 'user_incidencia';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'user_id', 
        'incidencia_id',
    ];
}
