<?php

namespace App\Models\Crm;

use App\Models\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nom035Levpedido extends Model
{
    use HasFactory;

    protected $table = 'nom035_levpedidos';

    //Define la clave primaria
    protected $primaryKey = 'id';

    //especifica las columnas
    protected $fillable = [
    'id','fecha', 'hora', 'numero_pedido', 'users_id', 'leads_clientes_id', 'sucursales_id', 'empresa_id',
    'numero_lead', 'nombre_cliente','medios_cesrh','fecha_y_hora','puesto','correo','correo_2','telefono','telefono_2',
    'nombre_contacto_2','puesto_contacto_2','tipo',
    ];

    public function crmcursos()
    {
        return $this->belongsToMany(CrmCurso::class);
    }

    public function leadcliente()
    {
        return $this->belongsTo(LeadCliente::class);
    }

    public function Nom035Cotizaciones()
    {
        return $this->hasMany(Nom035Cotizacione::class);
    }

    public function Nom035Informaciones()
    {
        return $this->belongsTo(Nom035Informacione::class);
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