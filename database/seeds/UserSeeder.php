<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::truncate();
        DB::table('admin_role')->truncate();
        $adminRolde = Role::where('role_name','admin')->first();
        $distributorRolde = Role::where('role_name','distributor')->first();
        $userRolde = Role::where('role_name','user')->first();
        
        $admin = Admin::create([
            'admin_name'=> 'le van duc',
            'admin_password'=>md5(1),
            'admin_email'=>'admin@gmail.com',
            'admin_phone'=>'0964246501',
        ]);

        $distributor = Admin::create([
            'admin_name'=> 'le thi nhung',
            'admin_password'=>md5(123),
            'admin_email'=>'lethinhung@gamil.com',
            'admin_phone'=>'0964246501',
        ]);

        $user = Admin::create([
            'admin_name'=> 'Nguyen Ngoc Quynh',
            'admin_password'=>md5(123),
            'admin_email'=>'nguyenngocquynh@gamil.com',
            'admin_phone'=>'0964246501',
        ]);

        $admin->role()->attach($adminRolde);
        $distributor->role()->attach($distributorRolde);
        $user->role()->attach($userRolde);
    }
}
