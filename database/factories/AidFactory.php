<?php

namespace Database\Factories;

use App\Models\Ngo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AidFactory extends Factory
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
            'description' => $this->faker->sentence,
            'ngo_id' => Ngo::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 100),
            'type' => $this->faker->randomElement([1, 2, 3]),
            //add the locations column here
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
}