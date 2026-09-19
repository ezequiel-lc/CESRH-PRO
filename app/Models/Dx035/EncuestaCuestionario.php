<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaCuestionario extends Model
{
    use HasFactory;

    protected $table = 'encuesta_cuestionario';

    protected $fillable = [
        'encuesta_id', 'cuestionario_id'
    ];

    // Relación con Encuesta
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuesta_id', 'Clave');
    }

    // Relación con Cuestionario
    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class, 'cuestionario_id');
    }

    public function getCompartirAttribute()
    {
        return '
            <div class="flex space-x-2">
                <button data-clave="' . $this->encuesta_clave . '" class="btn-copiar text-blue-500 hover:text-blue-700">
                    <i class="fas fa-copy"></i> Copiar
                </button>
                <button data-clave="' . $this->encuesta_clave . '" class="btn-compartir text-green-500 hover:text-green-700">
                    <i class="fas fa-share"></i> Compartir
                </button>
            </div>
        ';
    }
}
