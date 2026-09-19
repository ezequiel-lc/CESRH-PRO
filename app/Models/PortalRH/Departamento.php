<?php

namespace App\Models\PortalRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa el modelo User
use App\Models\PortalRH\Practicante;
class Departamento extends Model
{
    use HasFactory;

    //define que este modelo corresponde a la tabla departmtos en la base de datos.
    protected $table = 'departamentos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = ['id', 'nombre_departamento'];

    //->withPivot('sucursal_id', 'departamento_id', 'status');
    //, 'sucursal_departament', 'departamento_id', 'sucursal_id')
    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class)->withPivot('sucursal_id', 'departamento_id');
    }

    public function puestos()
    {
        return $this->belongsToMany(Puesto::class)->withPivot('departamento_id', 'puesto_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function becario()
    {
        return $this->hasMany(Becario::class);
    }

    public function trabajador()
    {
        return $this->hasMany(Trabajador::class);
    }

    public function practicante()
    {
        return $this->hasMany(Practicante::class);
    }

    public function instructor()
    {
        return $this->hasMany(Instructor::class);
    }

    // Relación con DatoTrabajador
    public function datoTrabajadores()
    {
        return $this->hasMany(DatoTrabajador::class, 'departamento_id');
    }

}
