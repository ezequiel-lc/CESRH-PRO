<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaReferencia extends Model
{
    use HasFactory;

    // Especifica el nombre correcto de la tabla en la base de datos
    protected $table = 'gias_referencias';

    // Define los campos que se pueden rellenar
    protected $fillable = ['numero_gia'];

    // Relación con el modelo Cuestionario
    public function cuestionarios()
    {
        return $this->hasMany(Cuestionario::class, 'giasreferencias_id');
    }

    // Relación con el modelo EncuestaGiaReferencia
    public function encuestasGiasReferencias()
    {
        return $this->hasMany(EncuestaGiaReferencia::class, 'giasreferencias_id');
    }
}
