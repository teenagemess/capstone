<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'nama_siswa' => $this->faker->name,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2005-12-31'),
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'tanggal_masuk' => $this->faker->date('Y-m-d', '2022-01-01'),
            'tanggal_keluar' => $this->faker->optional()->date('Y-m-d', '2024-12-31'),
        ];
    }
}
