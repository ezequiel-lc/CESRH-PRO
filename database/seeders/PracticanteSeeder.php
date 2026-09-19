<?php

namespace Database\Seeders;

use App\Models\PortalRH\Departament;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Practicant;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first(); // Obtén el primer usuario de la tabla users
        $sucursal = Sucursal::first(); // Obtén la primera sucursal de la tabla sucursales
        $departamento = Departamento::first(); // Obtén el primer departamento de la tabla departamentos

        $practicante = Practicante::create([
            'clave_practicante' => 'CPR12345',
            'numero_seguridad_social' => '9876543210',
            'fecha_nacimiento' => '2000-05-15',
            'lugar_nacimiento' => 'Guadalajara',
            'estado' => 'Jalisco',
            'codigo_postal' => '44100',
            'ocupacion' => 'Estudiante de Ingeniería',
            'sexo' => 'F',
            'curp' => 'CURP123456HJLLN01',
            'rfc' => 'RFC0987654321',
            'numero_celular' => '3333333333',
            'user_id' => $user->id, // Asigna el ID del usuario
            'sucursal_id' => $sucursal->id, // Asigna el ID de la sucursal
            'departamento_id' => $departamento->id, // Asigna el ID del departamento
        ]);


    }
}
