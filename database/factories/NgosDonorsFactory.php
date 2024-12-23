<?php

namespace Database\Factories;

use App\Models\Donor;
use App\Models\Ngo;
use App\Models\NgosDonors;
use Illuminate\Database\Eloquent\Factories\Factory;

class NgosDonorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $donor = Donor::inRandomOrder()->first();
        $ngo = Ngo::inRandomOrder()->first();

        $existingRecord = NgosDonors::where('donor_id', $donor->id)
            ->where('ngo_id', $ngo->id)
            ->first();

        // If an existing record is found, return its data
        if ($existingRecord) {
            return [
                'donor_id' => $existingRecord->donor_id,
                'ngo_id' => $existingRecord->ngo_id,
                'status' => $existingRecord->status,
                'rejected_at' => $existingRecord->status === 3 ? $existingRecord->rejected_at : null,
            ];
        }

        // Otherwise, create a new record with random data
        return [
            'donor_id' => $donor->id,
            'ngo_id' => $ngo->id,
            'status' => $this->faker->randomElement([1, 2, 3]),
            'rejected_at' => function (array $attributes) {
                return $attributes['status'] === 3 ? now() : null;
            },
        ];
    }
}