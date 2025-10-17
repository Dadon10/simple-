<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $officer = Role::firstOrCreate(['name' => 'Payroll Officer']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);

        $user = User::firstOrCreate(
            ['email' => 'admin@sanlam.test'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
        $user->assignRole($admin);
    }
}
