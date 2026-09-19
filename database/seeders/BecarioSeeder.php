<?php

namespace Database\Seeders;

use App\Models\PortalRH\Becari;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Departament;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén un usuario, sucursal y departamento existentes
        $user = User::first(); // Obtén el primer usuario de la tabla users
        $sucursal = Sucursal::first(); // Obtén la primera sucursal de la tabla sucursales
        $departamento = Departamento::first(); // Obtén el primer departamento de la tabla departamentos

        // Crea un nuevo becario y asigna los IDs relacionados
        $becario = Becario::create([
            'clave_becario' => 'BEC001',
            'numero_seguridad_social' => '123456789',
            'fecha_nacimiento' => '1990-01-01',
            'lugar_nacimiento' => 'Ciudad de México',
            'estado' => 'CDMX',
            'codigo_postal' => '12345',
            'ocupacion' => 'Estudiante',
            'sexo' => 'Masculino',
            'curp' => 'CURP123456789012',
            'rfc' => 'RFC123456789',
            'numero_celular' => '5512345678',
            'fecha_ingreso' => '2023-10-01',
            'status' => 'Activo',
            'calle' => 'Calle Falsa',
            'colonia' => 'Colonia Ficticia',
            'user_id' => $user->id, // Asigna el ID del usuario
            'sucursal_id' => $sucursal->id, // Asigna el ID de la sucursal
            'departamento_id' => $departamento->id, // Asigna el ID del departamento
        ]);


        //user_id	sucursal_id	departamento_id	

    }
}
