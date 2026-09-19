<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nom035Cotizacione extends Model
{
    use HasFactory;

    protected $table = 'nom035_cotizaciones';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'asesor', 'correo', 'telefono', 'clinombre', 'clipuesto', 'cliempresa', 'clicorreo', 'clitelefono', 'noCoti', 'fechaCoti', 'fechaVigencia', 'servicio', 'modalidad', 'asesoria', 'trabajadores', 'vacaciones', 'preciouni', 'precioSinIva', 'cotizacionesNom035'];


    public function nom035levpedidos()
    {
        return $this->belongsTo(Nom035Levpedido::class);
    }

    public function CotizacionesAprobadasNom()
    {
        return $this->hasOne(CotizacionesAprobadasNom::class);   
    }
}

