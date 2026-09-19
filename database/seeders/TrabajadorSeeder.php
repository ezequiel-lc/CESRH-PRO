<?php

namespace Database\Seeders;

use App\Models\PortalRH\Departament;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Trabajador;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = User::first(); // Obtén el primer usuario de la tabla users
        $sucursal = Sucursal::first(); // Obtén la primera sucursal de la tabla sucursales
        $departamento = Departamento::first(); // Obtén el primer departamento de la tabla departamentos

        $trabajador = Trabajador::create([
            'clave_trabajador' => 'CT12345',
            'numero_seguridad_social' => '1234567890',
            'fecha_nacimiento' => '1990-01-01',
            'lugar_nacimiento' => 'Ciudad de México',
            'estado' => 'CDMX',
            'codigo_postal' => '01000',
            'sexo' => 'M',
            'curp' => 'CURP123456HDFMR01',
            'rfc' => 'RFC123456789',
            'numero_celular' => '5555555555',
            'fecha_ingreso' => '2020-01-01',
            'edad' => 35,
            'estado_civil' => 'Soltero',
            'estudios' => 'Licenciatura',
            'ocupacion' => 'Ingeniero de Software',
            'tipo_puest' => 'Tiempo completo',
            'contratacion' => 'Permanente',
            'tipo_personal' => 'Administrativo',
            'jornada_trabajo' => 'Diurna',
            'rotacion' => 'No',
            'experiencia' => '5 años',
            'tiempo_puesto' => '2 años',
            'calle' => 'Av. Principal',
            'colonia' => 'Centro',
            'numero' => '123',
            'status' => 'Activo',
            'user_id' => $user->id, // Asigna el ID del usuario
            'sucursal_id' => $sucursal->id, // Asigna el ID de la sucursal
            'departamento_id' => $departamento->id, // Asigna el ID del departamento
        ]);

       
    }
}
