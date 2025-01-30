<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new CountrySeeder)->run();
        (new AuthorizationSeeder)->run();
        (new AdminSeeder)->run();
        (new SettingSeeder)->run();
        (new NgoSeeder)->run();
        (new ProviderSeeder)->run();
        (new LocationSeeder)->run();
        (new AidSeeder)->run();
        (new AidLocationSeeder)->run();
        (new DonorSeeder)->run();
        (new NgosDonorsSeeder)->run();
        (new UserSeeder)->run();
        (new NgosUsersSeeder)->run();
        (new ContactSeeder)->run();
    }
}
