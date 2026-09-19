<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosFiscale extends Model
{
    use HasFactory;
    protected $table = 'datos_fiscales';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'razon_social', 'rfc', 'calle', 'numero_exterior', 'numero_interior', 'colonia', 'municipio', 'localidad', 'estado', 'pais', 'codigo_postal', 'crm_empresas_id'];

    public function crmempresas()
    {
        return $this->belongsTo(CrmEmpresa::class);
    }
}