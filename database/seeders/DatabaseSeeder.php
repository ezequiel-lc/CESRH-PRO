<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //$this->call([RelacionesSeeder::class]);
        //$this->call([BecarioSeeder::class]);
        //$this->call([TrabajadorSeeder::class]);
        //$this->call([PracticanteSeeder::class]);
        // $this->call([EncuestaSeeder::class]);

        $this->call([UserRolDevSeeder::class]);
        $this->call([UserSeeder::class]);
    }
}
