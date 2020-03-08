<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'Administrator',
            'description' => 'Access to ALL'
        ]);

        Role::create([
            'role_name' => 'User',
            'description' => 'Access to ??'
        ]);
    }
}
