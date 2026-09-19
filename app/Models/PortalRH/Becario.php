<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User

class Becario extends Model
{
    use HasFactory;

    use HasFactory;
    //define que este modelo corresponde a la tabla xxx en la base de datos.
    protected $table = 'becarios';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id', 
        'clave_becario', 
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
        'fecha_ingreso',
        'status',
        'calle',
        'colonia',

        'user_id',
        'registro_patronal_id',
    ];

    //'departamento_id',
    //'puesto_id',

    //alcanze con el modelo 
    public function usuarios()
    {
        //un becario pertenece a un user
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function registroPatronal()
    {
        //cada trabajador pertenece a 
        return $this->belongsTo(RegistroPatronal::class);
    }

    /* 
    public function departamento()
    {
        //cada trabajador pertenece a 
        return $this->belongsTo(Departamento::class);
    }

    public function puesto()
    {
        //cada trabajador pertenece a 
        return $this->belongsTo(Puesto::class);
    }
    */
}
