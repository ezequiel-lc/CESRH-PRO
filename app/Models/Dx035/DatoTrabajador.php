<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoTrabajador extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'dato_trabajadores';

    protected $fillable = [
        'Nombre',
        'ApellidoPaterno',
        'ApellidoMaterno',
        'Sexo',
        'Edad',
        'EstadoCivil',
        'Estudios',
        'Ocupacion',
        'Departamento',
        'TipoPuesto',
        'Contratacion',
        'TipoPersonal',
        'JornadaTrabajo',
        'RotacionTurnos',
        'Experiencia',
        'TiempoPuesto',
        'Avance',
        'encuestas_id', // Relación con encuestas
        'users_id',     // Relación con users
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relación con Encuesta
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuestas_id');
    }

    // Relación con Respuesta
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'dato_trabajadores_id');
    }

    // Relación con Departamento (si es necesario)
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}