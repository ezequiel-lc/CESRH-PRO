<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    
    // Especificar la tabla en la base de datos
    protected $table = 'evidencias';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 'evidencias', 'comentarios', 'status', 'fecha'];

    // Relación muchos a muchos con CapacitacionesIndividuales
    public function capacitacionesIndividuales()
    {
        return $this->belongsToMany(CapacitacionIndividual::class, 'evidencia_cap_individual', 'evidencias_id', 'caps_individuales_id');
    }

    // Relación muchos a muchos con Participantes
    public function participantes()
    {
        return $this->belongsToMany(
            Participante::class,  // Modelo relacionado
            'participante_evidencia', // Nombre correcto de la tabla pivote
            'evidencias_id',  // Clave foránea de este modelo en la tabla pivote
            'participantes_id' // Clave foránea del otro modelo en la tabla pivote
        );
    }
}
