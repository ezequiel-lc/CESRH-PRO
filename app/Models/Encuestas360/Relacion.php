<?php

namespace App\Models\Encuestas360;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;

    protected $table = 'relaciones';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre'];
}
