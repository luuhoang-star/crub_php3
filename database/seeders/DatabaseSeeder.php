<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student; // Đảm bảo rằng Student được import đúng

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            Student::query()->create([
                'code' => fake()->randomDigit() . fake()->text(9),
                'name' => fake()->text(50),
                'email' => fake()->email(),
                'phone' => fake()->phoneNumber(),
                'image' => fake()->imageUrl(),
            ]);
        }
    }
}
