<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User
use App\Models\PortalRH\Departamento;

class Practicante extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'practicantes';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'clave_practicante', 
        'numero_seguridad_social',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'estado',
        'codigo_postal',
        'ocupacion',
        'sexo',
        'curp',
        'rfc',
        'numero_celular',

        'user_id',
        'registro_patronal_id',
    ];

    //alcanze con el modelo 
    public function user()
    {
        //cada trabajador pertenece a 
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registrosPatronales()
    {
        //cada trabajador pertenece a 
        return $this->belongsTo(RegistroPatronal::class);
    }

    /*
    
        'departamento_id',
        'puesto_id',

        public function departamentos()
        {
            //cada trabajador pertenece a 
            return $this->belongsTo(Departamento::class);
        }

        public function puestos()
        {
            //cada trabajador pertenece a 
            return $this->belongsTo(Puesto::class);
        }
    */
}
