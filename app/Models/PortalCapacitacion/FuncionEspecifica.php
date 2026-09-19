<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortalCapacitacion\PerfilPuesto;

class FuncionEspecifica extends Model
{
    use HasFactory;

    // Especificar la tabla en la base de datos
    protected $table = 
            'funciones_esp';

    // Definir la clave primaria,
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 'empresa_id',
            'sucursal_id', 'nombre'];

    // Relación muchos a muchos con perfiles_puestos
    public function perfiles_puestos()
    {
        return $this->belongsToMany(PerfilPuesto::class, 'funcion_esp_perfil_puesto', 'funciones_esp_id', 'perfiles_puestos_id'); // Modelo relacionado
    }

    // Relación uno a muchos con empresas
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relación uno a muchos con sucursales 
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

}

