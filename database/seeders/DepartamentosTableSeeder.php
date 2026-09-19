<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PortalRH\Departament;

class DepartamentosTableSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            ['nombre_departamento' => 'Recursos Humanos'],
            ['nombre_departamento' => 'Tecnología'],
            ['nombre_departamento' => 'Ventas'],
            ['nombre_departamento' => 'Marketing'],
            ['nombre_departamento' => 'Finanzas'],
            ['nombre_departamento' => 'Operaciones'],
        ];

        foreach ($departamentos as $departamento) {
            Departament::create($departamento);
        }
    }
}
