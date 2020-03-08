<?php

use App\UserRole;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'role_id' => 1,
            'user_id' => 1
        ]);

        UserRole::create([
            'role_id' => 2,
            'user_id' => 2
        ]);
    }
}
