<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioejeInformeje extends Model
{
    use HasFactory;

    protected $table = 'servicioeje_informeje';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'servicejec_id', 'infmejec_id'];

    public function LevantamientoPedidos()
    {
        return $this->hasMany(LevantamientoPedidos::class);
    }
}
