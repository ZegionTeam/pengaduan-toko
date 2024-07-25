<?php

namespace Database\Seeders;

use App\Models\Toko;
use Database\Factories\TokoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Toko::factory()->create([
            'nama' => 'Toko Sendiri',
            'villages_id' => 3603010008,
            'alamat' => 'Jl. Seadanya saja'
        ]);
    }
}
