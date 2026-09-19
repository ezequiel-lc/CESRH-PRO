<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dx035\Cuestionario;

class CuestionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuestionarios = [
            [
                'Nombre' => 'CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS',
                'giasreferencias_id' => 1 
            ],
            [
                'Nombre' => 'CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL EN LOS CENTROS DE TRABAJO',
                'giasreferencias_id' => 2
            ],
            [
                'Nombre' => 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACIÓN DEL ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO',
                'giasreferencias_id' => 3
            ]
        ];

        foreach ($cuestionarios as $cuestionario) {
            Cuestionario::create($cuestionario);
        }
    }
}
