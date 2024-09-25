<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminSeed extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'firstName' => 'george',
            'lastName' => 'zagh',
            'email' => 'george0@gmail.com',
            'password' => bcrypt('12341234a'),
            'phone' => '0987654321',
            'point' => 0
        ]);

        $admin = User::find(1);

        $role = Role::where('name', 'admin')->first();
        $admin->assignRole($role);
    }
}
