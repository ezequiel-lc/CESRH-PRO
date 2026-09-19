<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Politica extends Model
{
    use HasFactory;

    protected $fillable = ['Nombre', 'Accion_tomar'];

    public function encuestasPoliticas()
    {
        return $this->hasMany(EncuestaPolitica::class, 'politicas_id');
    }
}
