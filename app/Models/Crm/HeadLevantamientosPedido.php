<?php

namespace App\Models\Crm;

use App\Models\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadLevantamientosPedido extends Model
{
    use HasFactory;

    protected $table = 'head_levantamiento_pedidos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
    'id','fecha', 'hora', 'numero_pedido', 'users_id', 'leads_clientes_id', 'sucursales_id', 'empresa_id',
    'numero_lead', 'nombre_cliente','medios_cesrh','fecha_y_hora','puesto','correo','correo_2','telefono','telefono_2',
    'nombre_contacto_2','puesto_contacto_2','tipo',
    ];

    public function leadscliente()
    {
        return $this->belongsTo(LeadCliente::class);
    }

    public function serviciosejecutivo()
    {
        return $this->hasMany(ServiciosEjecutivo::class);
    }

    public function serviciosespecializado()
    {
        return $this->hasMany(ServiciosEspecializado::class);
    }

    public function serviciosoperativo()
    {
        return $this->hasMany(ServiciosOperativo::class);
    }

    public function empresa()
    {
        return $this->hasMany(Empresa::class);
    }

    public function sucursal()
    {
        return $this->hasMany(Sucursal::class);
    }
}