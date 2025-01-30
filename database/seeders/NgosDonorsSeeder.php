<?php

namespace Database\Seeders;

use App\Models\NgosDonors;
use Illuminate\Database\Seeder;

class NgosDonorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NgosDonors::factory()->count(1000)->create();
    }
}
