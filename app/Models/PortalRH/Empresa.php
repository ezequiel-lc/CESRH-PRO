<?php

namespace App\Models\PortalRH;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'empresas';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'nombre', 'razon_social', 'rfc', 'nombre_comercial', 'pais_origen', 'representante_legal', 'url_constancia_situacion_fiscal'];

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class)->withPivot('empresa_id', 'sucursal_id');
    }

    public function RegistroPatronal()
    {
        return $this->belongsToMany(RegistroPatronal::class)->withPivot('empresa_id', 'registro_patronal_id', 'status');
    }

    //**************************************************************

    public function users()
    {
        return $this->hasMany(User::class, 'empresa_id', 'id');
    }

    public function sucursaless()
    {
        return $this->hasMany(Sucursal::class, 'empresa_id', 'id');
    }
}
