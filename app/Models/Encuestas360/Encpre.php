<?php

namespace App\Models\Encuestas360;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encpre extends Model
{
    use HasFactory;

    protected $table = 'encpres';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'encuestas_id', 'preguntas_id', 'sucursal_id'];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta360::class, 'encuestas_id');
    }
    
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'preguntas_id');
    }
}
