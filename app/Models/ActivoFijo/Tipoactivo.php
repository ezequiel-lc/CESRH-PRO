<?php

namespace App\Models\ActivoFijo;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\ActivoFijo\Activos\ActivoOficina;
use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\ActivoFijo\Activos\ActivoUniforme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoactivo extends Model
{
    use HasFactory;
    protected $table = 'tipo_activos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'nombre_activo'
    ];

    public function anioestimados()
    {
        return $this->hasMany(Anioestimado::class); // Una venta pertenece a un cliente
    }
    public function activouniformes()
    {
        return $this->hasMany(ActivoUniforme::class); // Una venta pertenece a un cliente
    }
    public function activopapelerias()
    {
        return $this->hasMany(ActivoPapeleria::class);
    }
    public function activooficinas()
    {
        return $this->hasMany(ActivoOficina::class);
    }
    public function activotecnologias()
    {
        return $this->hasMany(ActivoTecnologia::class);
    }
    public function activomobiliarios()
    {
        return $this->hasMany(ActivoMobiliario::class);
    }
    public function activosouvenirs()
    {
        return $this->hasMany(ActivoSouvenir::class);
    }
}
