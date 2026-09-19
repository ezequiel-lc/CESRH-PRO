<?php

namespace Database\Seeders;

use App\Models\Encuestas360\Relacion;
use Illuminate\Database\Seeder;

class RelacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Relaciones = Relacion::create([
            'nombre' => 'Jefe'
        ]);

        //

        // $Client = Client::create([
        //     'numeroident' => '123456', // Solo números
        //     'nombre' => 'Juan Pérez',
        //     'direccion' => 'Av. Siempre Viva 123',
        //     'telefono' => '555-1234',
        //     'correoelec' => 'juan.perez@example.com',
        // ]);
    }
}
