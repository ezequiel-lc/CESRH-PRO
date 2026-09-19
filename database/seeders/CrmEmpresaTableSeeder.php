<?php

namespace Database\Seeders;

use App\Models\Crm\CrmEmpresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrmEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crmEmpresa = CrmEmpresa::create([
            'nombre' => 'Pepsi',
            'giro_empresa' => 'Refresquera',
            'calle' => 'las flores',
            'numero_exterior' => '2109',
            'numero_interior' => '23a',
            'colonia' => 'San Ramon',
            'municipio' => 'Puebla',
            'localidad' => 'Puebla',
            'estado' => 'Puebla',
            'pais' => 'México',
            'codigo_postal' => '72195',
            'tamano_empresa' => 'Grande',
            'pagina_web' => 'www.pepsi.com',
            'logotipo' => 'pepsi_logo.png',
            'clasificacion' => 'A+++'
        ]);

        $crmEmpresa1 = CrmEmpresa::create([
            'nombre' => 'Nestlé',
            'giro_empresa' => 'Alimenticia',
            'calle' => 'Av. Nestlé',
            'numero_exterior' => '100',
            'numero_interior' => '10',
            'colonia' => 'Centro',
            'municipio' => 'Ciudad de México',
            'localidad' => 'CDMX',
            'estado' => 'CDMX',
            'pais' => 'México',
            'codigo_postal' => '01000',
            'tamano_empresa' => 'Grande',
            'pagina_web' => 'www.nestle.com',
            'logotipo' => 'nestle_logo.png',
            'clasificacion' => 'A++'
        ]);

        $crmEmpresa2 = CrmEmpresa::create([
            'nombre' => 'Amazon',
            'giro_empresa' => 'Tecnología',
            'calle' => 'Amazon Blvd',
            'numero_exterior' => '200',
            'numero_interior' => '20',
            'colonia' => 'Tech Park',
            'municipio' => 'Seattle',
            'localidad' => 'Seattle',
            'estado' => 'Washington',
            'pais' => 'EE.UU.',
            'codigo_postal' => '98109',
            'tamano_empresa' => 'Grande',
            'pagina_web' => 'www.amazon.com',
            'logotipo' => 'amazon_logo.png',
            'clasificacion' => 'A+++'
        ]);

        $crmEmpresa3 = CrmEmpresa::create([
            'nombre' => 'Tesla',
            'giro_empresa' => 'Automotriz',
            'calle' => 'Tesla Road',
            'numero_exterior' => '300',
            'numero_interior' => '30',
            'colonia' => 'Innovation District',
            'municipio' => 'Palo Alto',
            'localidad' => 'Palo Alto',
            'estado' => 'California',
            'pais' => 'EE.UU.',
            'codigo_postal' => '94304',
            'tamano_empresa' => 'Grande',
            'pagina_web' => 'www.tesla.com',
            'logotipo' => 'tesla_logo.png',
            'clasificacion' => 'A++'
        ]);

        $crmEmpresa4 = CrmEmpresa::create([
            'nombre' => 'Starbucks',
            'giro_empresa' => 'Alimentos y Bebidas',
            'calle' => 'Coffee Ave',
            'numero_exterior' => '400',
            'numero_interior' => '40',
            'colonia' => 'Café Central',
            'municipio' => 'Seattle',
            'localidad' => 'Seattle',
            'estado' => 'Washington',
            'pais' => 'EE.UU.',
            'codigo_postal' => '98101',
            'tamano_empresa' => 'Mediana',
            'pagina_web' => 'www.starbucks.com',
            'logotipo' => 'starbucks_logo.png',
            'clasificacion' => 'A+'
        ]);

        $crmEmpresa5 = CrmEmpresa::create([
            'nombre' => 'Uber',
            'giro_empresa' => 'Transporte',
            'calle' => 'Ride Sharing St',
            'numero_exterior' => '500',
            'numero_interior' => '50',
            'colonia' => 'Mobility Hub',
            'municipio' => 'San Francisco',
            'localidad' => 'San Francisco',
            'estado' => 'California',
            'pais' => 'EE.UU.',
            'codigo_postal' => '94103',
            'tamano_empresa' => 'Mediana',
            'pagina_web' => 'www.uber.com',
            'logotipo' => 'uber_logo.png',
            'clasificacion' => 'A++'
        ]);
    }
}
