<?php

namespace Database\Seeders;

use App\Models\Aid;
use Illuminate\Database\Seeder;

class AidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aid::factory()->count(1000)->create();
    }
}
