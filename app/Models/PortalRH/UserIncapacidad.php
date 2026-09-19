<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIncapacidad extends Model
{
    use HasFactory;

    protected $table = 'user_incapacidad';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'user_id', 
        'incapacidad_id',
    ];
}
