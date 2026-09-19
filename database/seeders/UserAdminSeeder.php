<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
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

    }
}
