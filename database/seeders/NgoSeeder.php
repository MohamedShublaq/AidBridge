<?php

namespace Database\Seeders;

use App\Models\Ngo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NgoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ngo::factory()->count(3)->create();
    }
}