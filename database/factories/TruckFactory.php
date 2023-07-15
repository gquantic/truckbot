<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truck>
 */
class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition()
    {
        return [
            'city_id' => City::query()->inRandomOrder()->first()->id,
            'manager_id' => User::query()->inRandomOrder()->first()->id,
            'manufacturer' => fake()->name,
            'model' => fake()->jobTitle,
            'numbers' => rand(111, 999),
            'phone' => fake()->phoneNumber,
            'online' => rand(0, 1),
        ];
    }
}
