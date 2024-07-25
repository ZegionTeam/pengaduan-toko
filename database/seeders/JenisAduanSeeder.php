<?php

namespace Database\Seeders;

use App\Models\JenisAduan;
use Database\Factories\JenisAduanFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisAduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisAduan::factory()->create([
            'nama' => 'Pintu Utama/Loring Dor'
        ]);
        JenisAduan::factory()->create([
            'nama' => 'Lampu Toko'
        ]);
        JenisAduan::factory()->create([
            'nama' => 'Perbaikan AC'
        ]);
        JenisAduan::factory()->create([
            'nama' => 'Meja Kasir'
        ]);
        JenisAduan::factory()->create([
            'nama' => 'Lemari Pendingin'
        ]);
        JenisAduan::factory()->create([
            'nama' => 'Rak Barang'
        ]);
    }
}
