<?php

namespace Database\Factories;

use App\Models\Ngo;
use App\Models\NgosUsers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NgosUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $ngo = Ngo::inRandomOrder()->first();

        $existingRecord = NgosUsers::where('user_id', $user->id)
            ->where('ngo_id', $ngo->id)
            ->first();

        // If an existing record is found, return its data
        if ($existingRecord) {
            return [
                'user_id' => $existingRecord->user_id,
                'ngo_id' => $existingRecord->ngo_id,
                'status' => $existingRecord->status,
                'rejected_at' => $existingRecord->status === 3 ? $existingRecord->rejected_at : null,
            ];
        }

        // Otherwise, create a new record with random data
        return [
            'user_id' => $user->id,
            'ngo_id' => $ngo->id,
            'status' => $this->faker->randomElement([1, 2, 3]),
            'rejected_at' => function (array $attributes) {
                return $attributes['status'] === 3 ? now() : null;
            },
        ];
    }
}