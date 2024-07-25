<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        // User::factory()->create([
        //     'nik' => '2013134820',
        //     'name' => 'Aris Imam Tanggi',
        //     'role' => 'pemeliharaan',
        //     'tokos_id' => 1
        // ]);

        // User::factory()->create([
        //     'nik' => '2015031745',
        //     'name' => 'Dani Rukmana',
        //     'role' => 'karyawan',
        //     'tokos_id' => 1
        // ]);
        User::factory()->create([
            'nik' => '2015031746',
            'name' => 'Dani Rukmana',
            'role' => 'karyawan',
            'tokos_id' => 2
        ]);
    }
}
