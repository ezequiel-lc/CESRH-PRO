<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User

class Trabajador extends Model
{
    use HasFactory;

    use HasFactory;
    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'trabajadores';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'clave_trabajador', 
        'numero_seguridad_social',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'estado',
        'codigo_postal',
        'sexo',
        'curp',
        'rfc',
        'numero_celular',
        'fecha_ingreso',
        'edad',
        'estado_civil',
        'estudios',
        'ocupacion',
        'tipo_puest',
        'contratacion',
        'tipo_personal',
        'jornada_trabajo',
        'rotacion',
        'experiencia',
        'tiempo_puesto',
        'calle',
        'colonia',
        'numero',
        'status',

        'user_id',
        'registro_patronal_id',
    ];

    public function salarios()
    {
        return $this->belongsToMany(Salario::class)->withPivot('salario_id', 'trabajador_id', 'status');
    }

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
