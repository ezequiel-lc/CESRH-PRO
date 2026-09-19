<?php

namespace App\Models\Dx035;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioDx035 extends Model
{
    use HasFactory;

    protected $table = 'usuariosdx035';
    protected $primaryKey = 'CorreoElectronico';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CorreoElectronico', 'NombreUsuario', 'Password', 'Autoridad',
        'FechaInicio', 'FechaFinal', 'Expiracion', 'Estado', 'Telefono',
        'CodigoRecuperacion', 'Cargo', 'users_id'
    ];
}
