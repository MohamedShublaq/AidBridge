<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Seeder;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [];
        foreach(config('authorizations.Permissions') as $permission=>$value ){
            $permissions[] = $permission;
        }
        Authorization::create([
            'role' => 'Manager',
            'permissions' => json_encode($permissions),
        ]);
    }
}