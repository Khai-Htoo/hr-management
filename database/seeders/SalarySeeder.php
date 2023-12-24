<?php

namespace Database\Seeders;

use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{

    public function run(): void
    {
        $user = User::get();
        foreach ($user as $u) {
            Salary::create([
                'user_id' => $u->id,
                'month' => '01',
                'year' => '2023',
                'amount' => 1000000,
            ]);
        }

    }
}
