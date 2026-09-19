<?php

namespace App\Models\Encuestas360;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compromiso extends Model
{
    use HasFactory;

    protected $table = 'compromisos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'alta', 'vencimiento', 'compromiso', 'verificado', 'users_id', 'preguntas_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'preguntas_id');
    }
}
