<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class createSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //create super admin 
        User::create([
            'first_name' => 'SuperAdmin@123',
            'email' => 'everspice.ceylone@gmail.com',
            'password' => Hash::make('1234@5678'),
            'role' => "superAdmin",
        ]);

        //create role
        $role = Role::create(['name' => 'super_admin']);
        $role = Role::create(['name' => 'admin']);


        //    assign seeded user to superadmin role 
        $super_admin = User::where('first_name', 'SuperAdmin@123')->first();
        $super_admin->assignRole('super_admin');
    }
}
