<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCapacitacionEscaneado extends Model
{
    use HasFactory;

    protected $fillable = ['doc_scaneado', 'planes_capacitaciones_idplanes_capacitaciones'];

    public function encuestasPoliticas()
    {
        return $this->hasMany(EncuestaPolitica::class, 'planes_capacitaciones_escaneados_id');
    }
}
