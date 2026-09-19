<?php

namespace App\Models\Crm;

use App\Models\User;
use App\Models\Crm\DatosFiscale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadCliente extends Model
{
    use HasFactory;

    protected $table = 'leads_clientes';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
        'id',
        'numero_lead',
        'nombre_cliente',
        'users_id',
        'medios_cesrh',
        'fecha_y_hora',
        'crm_empresas_id',
        'puesto',
        'correo',
        'correo_2',
        'telefono',
        'telefono_2',
        'nombre_contacto_2',
        'puesto_contacto_2',
        'tipo'
    ];

    public function empresa()
    {
        return $this->belongsTo(CrmEmpresa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function headlevantamientospedidos()
    {
        return $this->hasMany(HeadLevantamientosPedido::class);
    }

    public function nom035levpedidos()
    {
        return $this->hasMany(Nom035Levpedido::class);
    }

    public function EsmartLevantamientos()
    {
        return $this->hasMany(EsmartLevantamiento::class);
    }

    public function traininglevantamientos()
    {
        return $this->hasMany(TrainingLevantamiento::class);
    }
}
