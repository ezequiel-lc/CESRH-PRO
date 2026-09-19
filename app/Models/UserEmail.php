<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = [
        'email', // Solo el campo 'email' se puede asignar masivamente
    ];

    // Campos ocultos al serializar
    protected $hidden = [
        'created_at', 'updated_at', // Oculta las marcas de tiempo
    ];

    // Valores por defecto
    protected $attributes = [
        'status' => 'active', // Ejemplo: un campo 'status' con valor por defecto 'active'
    ];

    // Accesores
    public function getEmailAttribute($value)
    {
        return strtoupper($value); // Convierte el correo a mayúsculas
    }

    // Mutadores
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim(strtolower($value)); // Convierte el correo a minúsculas y elimina espacios
    }

    // Scopes personalizados
    public function scopeActive($query)
    {
        return $query->where('status', 'active'); // Filtra correos activos
    }

    // Relación con el modelo User 
    public function user()
    {
        return $this->belongsTo(User::class); // Relación "pertenece a" con el modelo User
    }

    // Método para enviar invitaciones
    public function sendSurveyInvitation()
    {
        $surveyLink = route('survey.show', ['key' => $this->generateKey()]); // Genera el enlace de la encuesta

        // Envía el correo
        Mail::to($this->email)->send(new SurveyInvitation($surveyLink));

        return true;
    }

    // Método para generar una clave única
    private function generateKey()
    {
        return substr(md5(uniqid(rand(), true)), 0, 10); // Genera una clave única
    }
}
