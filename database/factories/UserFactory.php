<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail(),
            'id_number' => $this->faker->unique()->numerify('#######'),
            'password' => Hash::make('password'),
            'country_id' => Country::inRandomOrder()->first()->id,
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement([0,1]),
            'age' => $this->faker->numberBetween(1, 100),
            'marital_status' => $this->faker->randomElement([1, 2, 3, 4]),
            'childrens' => function (array $attributes) {
                return $attributes['marital_status'] === 1 ? null : $this->faker->numberBetween(0, 15);
            },
            'joining_way' => $this->faker->randomElement([0,1]),
            'added_by_provider' => function (array $attributes) {
                return $attributes['joining_way'] === 1 ? Provider::inRandomOrder()->first()->id : null;
            },
            'email_verified_at' => now(),
            'created_at' => Carbon::create(
                2024,
                $this->faker->numberBetween(1, 11), // Random month (1 to 11)
                $this->faker->numberBetween(1, 28), // Random day (1 to 28, to avoid invalid dates)
                $this->faker->numberBetween(0, 23), // Random hour (0 to 23)
                $this->faker->numberBetween(0, 59), // Random minute (0 to 59)
                $this->faker->numberBetween(0, 59)  // Random second (0 to 59)
            ),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}