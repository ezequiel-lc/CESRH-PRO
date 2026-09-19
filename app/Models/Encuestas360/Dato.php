<?php

namespace App\Models\Encuestas360;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;

    protected $table = 'datos';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion'];
}
