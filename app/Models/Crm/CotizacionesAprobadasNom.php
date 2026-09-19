<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionesAprobadasNom extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones_aprobadas_nom';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'fecha_aprobacion', 'email_enviado', 'nom035cotizaciones_id'];

    public function Nom035Cotizaciones()
    {
        return $this->belongsTo(Nom035Cotizacione::class);
    }
}