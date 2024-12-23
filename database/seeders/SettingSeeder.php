<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email' => 'aidBridge2025@gmail.com',
            'phone' => '+201999999999',
            'street' => 'street',
            'city' => 'gaza',
            'country' => 'Palestine',
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' => 'instagram',
            'linkedin' => 'linkedin',
        ]);
    }
}