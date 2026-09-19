<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identificadore extends Model
{
    use HasFactory;

    protected $table = 'identificadores';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'clasificacion_cliente', 'servicio', 'empresa_id'];

    public function crmempresa()
    {
        return $this->hasMany(CrmEmpresa::class);
    }
}