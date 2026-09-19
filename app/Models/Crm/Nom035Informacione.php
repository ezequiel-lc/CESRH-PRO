<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nom035Informacione extends Model
{
    use HasFactory;

    protected $table = 'nom035_informaciones';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'cuantos_participantes', 'cuantos_centros_trabajo', 'primera_vez', 'integral_o_software', 'inspeccion'];

    public function Nom035Levpedido()
    {
        return $this->hasMany(Nom035Levpedido::class);
    }
}
