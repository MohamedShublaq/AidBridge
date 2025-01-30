<?php

namespace Database\Factories;

use App\Models\Ngo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AidFactory extends Factory
{
    public const NUTRITIONAL = 1;
    public const CASH = 2;
    public const MEDICAL = 3;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $from = $this->faker->dateTimeBetween('2024-01-01', '2024-12-31');
        $due = $this->faker->dateTimeBetween($from, '2025-12-31');
        $createdAt = Carbon::create(
            2024,
            $this->faker->numberBetween(1, 11), // Random month (1 to 11)
            $this->faker->numberBetween(1, 28), // Random day (1 to 28, to avoid invalid dates)
            $this->faker->numberBetween(0, 23), // Random hour (0 to 23)
            $this->faker->numberBetween(0, 59), // Random minute (0 to 59)
            $this->faker->numberBetween(0, 59)  // Random second (0 to 59)
        );

        $aidCategories = [
            self::NUTRITIONAL => ['Food Package', 'Nutritional Supplements', 'Emergency Rations', 'Infant Formula'],
            self::CASH => ['Cash Assistance', 'Emergency Funds', 'Microfinance Support', 'Unconditional Cash Transfer'],
            self::MEDICAL => ['Medical Kit', 'First Aid Supplies', 'Vaccination Support', 'Surgical Equipment'],
        ];

        // Randomly select a type
        $type = $this->faker->randomElement(array_keys($aidCategories));

        return [
            'name' => $this->faker->randomElement($aidCategories[$type]),
            'description' => $this->faker->sentence,
            'ngo_id' => Ngo::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 100),
            'type' => $type,
            'from' => $from->format('Y-m-d'),
            'due' => $due->format('Y-m-d'),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
