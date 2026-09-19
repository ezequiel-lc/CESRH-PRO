<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'name'=>'ADMINISTRADOR',
            'email'=> 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Trabajador'
        ])->assignRole('GoldenAdmin');

        $user=User::create([
            'name'=>'ADMINISTRADOR EMPRESA',
            'email'=>'empresaadmin@gmail.com',
            'password' => Hash::make('123456789$$$'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Trabajador'
        ])->assignRole('EmpresaAdmin');

        $user=User::create([
            'name'=>'ADMINISTRADOR SUCURSAL',
            'email'=>'sucursal@gmail.com',
            'password' => Hash::make('123sucursal$$$'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Trabajador'
        ])->assignRole('SusursalAdmin');

        $user=User::create([
            'name'=>'Trabajador ENCUESTA 360',
            'email'=>'becartio@gmail.com',
            'password' => Hash::make('123encuesta360$$$'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Becario'
        ])->assignRole('Trabajador ENCUESTA 360');

        $user=User::create([
            'name'=>'Trabajador Global',
            'email'=>'practicante@gmail.com',
            'password' => Hash::make('prodiangelo$$$'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Practicante'
        ])->assignRole('Trabajador GLOBAL');
        
        $user=User::create([
            'name'=>'Carmela Vazquez',
            'email'=>'carme@gmail.com',
            'password' => Hash::make('12345678'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Practicante'
        ])->assignRole('GoldenAdmin','Trabajador ACTIVO FIJO');

        $user=User::create([
            'name'=>'Adan Leyva Rodrigez',
            'email'=>'adan@gmail.com',
            'password' => Hash::make('prodiangelo$$$'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Practicante'
        ])->assignRole('Trabajador PORTAL CAPACITACION');

        $user=User::create([
            'name'=>'Elisa Refugio',
            'email'=>'elisa@gmail.com',
            'password' => Hash::make('123sucursal'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Trabajador'
        ])->assignRole('Trabajador PORTAL CAPACITACION');

        $user=User::create([
            'name'=>'ADMIN Eli',
            'email'=>'eli@gmail.com',
            'password' => Hash::make('123456789'),
            'empresa_id' => 1,
            'sucursal_id' => 1,
            'tipo_user' => 'Trabajador'
        ])->assignRole('Trabajador PORTAL CAPACITACION');
        // $user=User::create([
        //     'name'=>'Trabajador PORTAL CAPACITACION',
        //     'email'=>'portal@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'empresa_id' => 1,
        //     'sucursal_id' => 1,
        //     'tipo_user' => 'Practicante'
        // ])->assignRole('Trabajador PORTAL CAPACITACION');

        // $user=User::create([
        //     'name'=>'Trabajador Global',
        //     'email'=>'practicante@gmail.com',
        //     'password' => Hash::make('prodiangelo$$$'),
        //     'empresa_id' => 1,
        //     'sucursal_id' => 1,
        //     'tipo_user' => 'Practicante'
        // ])->assignRole('Trabajador GLOBAL');

        // $user=User::create([
        //     'name'=>'Elisa Refugio',
        //     'email'=>'elisa@gmail.com',
        //     'password' => Hash::make('123sucursal'),
        //     'empresa_id' => 2,
        //     'sucursal_id' => 2,
        //     'tipo_user' => 'Trabajador'
        // ])->assignRole('SusursalAdmin');

        // $user=User::create([
        //     'name'=>'ADMIN Eli',
        //     'email'=>'eli@gmail.com',
        //     'password' => Hash::make('123456789'),
        //     'empresa_id' => 2,
        //     'sucursal_id' => 2,
        //     'tipo_user' => 'Trabajador'
        // ])->assignRole('EmpresaAdmin');
    }
}
