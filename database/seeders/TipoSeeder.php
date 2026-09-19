<?php

namespace Database\Seeders;

use App\Models\ActivoFijo\Tipoactivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Tecnologias'
        ]);
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Papelerias'
        ]);
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Oficinas'
        ]);
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Souvenirs'
        ]);
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Mobiliarios'
        ]);
        $tipo= Tipoactivo::create([
            'nombre_activo'=>'Activo Uniformes'
        ]);
    }
}
