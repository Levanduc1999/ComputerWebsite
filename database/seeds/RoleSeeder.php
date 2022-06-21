<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['role_name'=>'admin']);
        Role::create(['role_name'=>'distributor']);
        Role::create(['role_name'=>'user']);
    }
}
