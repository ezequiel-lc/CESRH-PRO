<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GiasReferenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gias_referencias')->insert([
            ['numero_gia' => 'GIA-001'],
            ['numero_gia' => 'GIA-002'],
            ['numero_gia' => 'GIA-003'],
        ]);
    }
}
