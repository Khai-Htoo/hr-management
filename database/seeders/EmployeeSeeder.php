<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'employee_id' => '001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
            'phone' => '09794257469',
            'address' => 'Yangon',
            'nrc_number' => '192865',
            'pin_code' => '123123',
            'department_id' => '1',
        ]);
        $admin->syncRoles('Hr');

    }
}
