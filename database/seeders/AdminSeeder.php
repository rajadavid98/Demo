<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $admins =  [
            [
                'name'=>'admin1',
                'email'=>'admin1@mailinator.com',
                'password' => Hash::make('admin1@123'),
            ],
            [
                'name'=>'admin2',
                'email'=>'admin2@mailinator.com',
                'password' => Hash::make('admin2@123'),
            ],
            [
                'name'=>'admin3',
                'email'=>'admin3@mailinator.com',
                'password' => Hash::make('admin3@123'),
            ],
        ];

        $role = Role::whereName('Admin')->whereGuardName('admin')->first();

        foreach ($admins as $admin) {
            $admin = Admin::create($admin);
            $admin->assignRole($role->id);
        }
    }
}
