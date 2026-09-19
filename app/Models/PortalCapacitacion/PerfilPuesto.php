<?php

namespace App\Models\PortalCapacitacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPuesto extends Model
{
    use HasFactory;
    // Especificar la tabla en la base de datos
    protected $table = 'perfiles_puestos';

    // Definir la clave primaria
    protected $primaryKey = 'id';

    // Columnas asignables masivamente
    protected $fillable = ['id', 
            'nombre_puesto',
            'empresa_id',
            'sucursal_id',
            'area', 
            'proceso',
            'mision',
            'puesto_reporta',
            'puestos_que_le_reportan',
            'suplencia',
            'rango_toma_desicones',
            'desiciones_directas',
            'rango_edad_desable',
            'sexo_preferente',
            'estado_civil_deseable',
            'escolaridad',
            'idioma_requerido',
            'experiencia_requerida',
            'nivel_riesgo_fisico',
            'elaboro_nombre',
            'elaboro_puesto',
            'reviso_nombre',
            'reviso_puesto',
            'autorizo_nombre',
            'autorizo_puesto',
            'status',
    ];

    public function funcionesEspecificas()
    {
        return $this->belongsToMany(FuncionEspecifica::class, 'funcion_esp_perfil_puesto', 'perfiles_puestos_id', 'funciones_esp_id');
    }

    public function relacionesInternas(){
        return $this->belongsToMany(RelacionInterna::class, 'relacion_interna_perfil_puesto', 'perfiles_puestos_id', 'relaciones_internas_id');
    }

    public function relacionesExternas(){
        return $this->belongsToMany(RelacionExterna::class, 'relacion_externa_perfil_puesto', 'perfiles_puestos_id', 'relaciones_externas_id');
    }

    public function responsabilidadesUniversales(){
        return $this->belongsToMany(ResponsabilidadUniversal::class, 'respon_univ_perfil_puesto', 'perfiles_puestos_id', 'respons_univ_id');
    }

    public function habilidadesHumanas(){
        return $this->belongsToMany(FormacionHabilidadHumana::class, 'formacion_humana_perfil_puesto', 'perfiles_puestos_id', 'formaciones_humanas_id');
    }

    public function habilidadesTecnicas(){
        return $this->belongsToMany(FormacionHabilidadTecnica::class, 'formacion_tecnica_perfil_puesto', 'perfiles_puestos_id', 'formaciones_tecnicas_id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'perfil_puesto_user', 'perfiles_puestos_id', 'users_id')
            ->withPivot(['status', 'fecha_inicio', 'fecha_final', 'motivo_cambio']);
    }

    public function evaluaciones()
    {
        return $this->belongsToMany(Evaluacion::class, 'evaluacion_perfil_puesto', 'evaluaciones_id', 'perfiles_puestos_id');
    }


}
