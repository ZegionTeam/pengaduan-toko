<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'laporan' => fake()->text(50),
            'pelapor' => 2,
            'jenis_aduans_id' => random_int(1, 6),
            'foto' => fake()->randomElement(['1720766521.jpg', '1720766701.png', '1720766717.jpg'])
        ];
    }
}
