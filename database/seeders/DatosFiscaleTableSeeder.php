<?php

namespace Database\Seeders;

use App\Models\Crm\DatosFiscale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatosFiscaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datofiscal1 = DatosFiscale::create([
            'razon_social' => 'Empresa Chida S. de RL',
            'rfc' => 'ECH220315XYZ ',
            'calle' => 'Ficticia ',
            'numero_exterior' => '123',
            'numero_interior' => '',
            'colonia' => 'Inventada',
            'municipio' => 'Alcaldía Azcapotzalco',
            'localidad' => 'San Pedro Xalpa',
            'estado' => 'CDMX',
            'pais' => 'México',
            'codigo_postal' => '02250',
            'crm_empresas_id' => '1'
        ]);
        $datofiscal2 = DatosFiscale::create([
            'razon_social' => 'Empresa MAS Chida S. de RL',
            'rfc' => 'EMC230528 ',
            'calle' => 'Avenida México 2000',
            'numero_exterior' => '456',
            'numero_interior' => '5A',
            'colonia' => 'Las Fuentes',
            'municipio' => 'Guadalajara',
            'localidad' => 'Guadalajara',
            'estado' => 'Jalisco',
            'pais' => 'México',
            'codigo_postal' => '44440',
            'crm_empresas_id' => '5'
        ]);
        $datofiscal3 = DatosFiscale::create([
            'razon_social' => 'Taquerías Los Carnales',
            'rfc' => 'TLC250206HDFRNS02 ',
            'calle' => 'Calle 5 de Febrero',
            'numero_exterior' => '45',
            'numero_interior' => '2',
            'colonia' => 'Anzures',
            'municipio' => 'Puebla',
            'localidad' => 'Puebla',
            'estado' => 'Puebla',
            'pais' => 'México',
            'codigo_postal' => '72530',
            'crm_empresas_id' => '2'
        ]);
        $datofiscal4 = DatosFiscale::create([
            'razon_social' => 'Tiendas Don Baraton',
            'rfc' => 'TDB230206A22 ',
            'calle' => 'Avenida Principal 101',
            'numero_exterior' => '200',
            'numero_interior' => '10',
            'colonia' => 'Centro',
            'municipio' => 'Puebla',
            'localidad' => 'Puebla',
            'estado' => 'Puebla',
            'pais' => 'México',
            'codigo_postal' => '72000',
            'crm_empresas_id' => '3'
        ]);
        $datofiscal5 = DatosFiscale::create([
            'razon_social' => 'Patito S.A. de C.V.',
            'rfc' => 'PAT230315X9A ',
            'calle' => 'Reforma ',
            'numero_exterior' => 'S/N',
            'numero_interior' => '101-A',
            'colonia' => 'La Paz',
            'municipio' => 'Puebla',
            'localidad' => 'Puebla',
            'estado' => 'Puebla',
            'pais' => 'México',
            'codigo_postal' => '72160',
            'crm_empresas_id' => '4'
        ]);
    }
}
