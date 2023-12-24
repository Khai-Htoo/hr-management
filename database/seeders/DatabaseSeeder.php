<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DepartmentSeeder::class,
            CompanyData::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            EmployeeSeeder::class,
            AttendanceSeeder::class,
            SalarySeeder::class,
            AttendanceSeeder::class,
        ]);

    }
}
