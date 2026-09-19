<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmEmpresa extends Model
{
    use HasFactory;

    protected $table = 'crm_empresas';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id',  'nombre', 'giro_empresa', 'calle', 'numero_exterior', 'numero_interior', 'colonia', 'municipio', 'localidad', 'estado', 'pais', 'codigo_postal', 'tamano_empresa', 'pagina_web', 'logotipo', 'clasificacion'];

    public function datosfiscales()
    {
        return $this->hasMany(DatosFiscale::class);
    }
}