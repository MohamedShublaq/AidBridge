<?php

namespace Database\Factories;

use App\Models\Ngo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'ngo_id' => Ngo::inRandomOrder()->first()->id,
        ];
    }
}