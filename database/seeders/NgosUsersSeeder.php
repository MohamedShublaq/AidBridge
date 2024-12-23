<?php

namespace Database\Seeders;

use App\Models\NgosUsers;
use Illuminate\Database\Seeder;

class NgosUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NgosUsers::factory()->count(100)->create();
    }
}