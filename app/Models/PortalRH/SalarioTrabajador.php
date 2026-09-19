<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarioTrabajador extends Model
{
    use HasFactory;

    protected $table = 'salari_trabajador';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'salario_id',
        'trabajador_id',
        'status',
    ];
}
