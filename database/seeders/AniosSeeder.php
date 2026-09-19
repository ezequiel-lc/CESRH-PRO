<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivoFijo\Anioestimado;

class AniosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anio = Anioestimado::create([
            'vida_util_año' => '1',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '2',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '3',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '4',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '5',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '6',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '7',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '8',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '9',
            'tipo_activo_id'=>'1'
        ]);
        $anio = Anioestimado::create([
            'vida_util_año' => '10',
            'tipo_activo_id'=>'1'
        ]);
    }
}
