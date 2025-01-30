<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class NgoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createdAt = Carbon::create(
            2024,
            $this->faker->numberBetween(1, 11), // Random month (1 to 11)
            $this->faker->numberBetween(1, 28), // Random day (1 to 28, to avoid invalid dates)
            $this->faker->numberBetween(0, 23), // Random hour (0 to 23)
            $this->faker->numberBetween(0, 59), // Random minute (0 to 59)
            $this->faker->numberBetween(0, 59)  // Random second (0 to 59)
        );

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'description' => $this->faker->sentence,
            'address' => $this->faker->streetAddress,
            'phone' => $this->faker->phoneNumber,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
