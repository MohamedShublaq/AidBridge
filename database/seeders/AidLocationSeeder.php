<?php

namespace Database\Seeders;

use App\Models\Aid;
use App\Models\AidLocation;
use App\Models\Location;
use Illuminate\Database\Seeder;

class AidLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aid::all()->each(function ($aid) {
            // Get locations that belong to the same NGO as the aid
            $locations = Location::where('ngo_id', $aid->ngo_id)->inRandomOrder()->limit(3)->get();

            foreach ($locations as $location) {
                AidLocation::create([
                    'aid_id' => $aid->id,
                    'location_id' => $location->id,
                ]);
            }
        });
    }
}
