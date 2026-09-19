<?php

namespace Database\Seeders;

use App\Models\Crm\LeadCliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadsClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leadcliente = LeadCliente::create([
            'nombre_contacto' => 'Jose',
            'users_id' => '1',
            'numero_cliente' => '123456789',
            'fecha' => '2025-12-02',
            'hora' => '15:35:00',
            'datos_id' => 5,
            'puesto' => 'Obrero',
            'correo' => 'jose_obrero@gmail.com',
            'telefono' => '0123456789',
            'tipo' => 'lead',
        ]);
        // $leadcliente2 = LeadsCliente::create([
        //     'nombre_contacto' => 'Juan',
        //     'users_id' => '2',
        //     'numero_cliente' => '9876543210',
        //     'fecha' => '2025-12-02',
        //     'hora' => '19:01:56',
        //     'datos_id' => 5,
        //     'puesto' => 'Mecanico',
        //     'correo' => 'juan_mecanico@gmail.com',
        //     'telefono' => '9876543210',
        //     'tipo' => 'cliente',
        // ]);

    }
}