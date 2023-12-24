<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{

    public function run(): void
    {
        // department
        $department = ['Web Design', 'Web Developer', 'Mobile Developer'];
        foreach ($department as $d) {
            \App\Models\Department::create([
                'name' => $d,
            ]);
        }

    }
}
