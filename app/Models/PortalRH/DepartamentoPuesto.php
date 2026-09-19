<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoPuesto extends Model
{
    use HasFactory;

    protected $table = 'departamento_puesto';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'departamento_id',
        'puesto_id',
        'status',
    ];


    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }
}
