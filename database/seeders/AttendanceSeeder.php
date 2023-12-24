<?php

namespace Database\Seeders;

use App\Models\Check;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::get();
        foreach ($users as $user) {
            $period = new CarbonPeriod('2023-01-01', '2023-12-31');
            foreach ($period as $p) {
                if ($p->format('D') != 'Sat' && $p->format('D') != 'Sun') {
                    Check::create([
                        'user_id' => $user->id,
                        'date' => $p->format('Y-m-d'),
                        'check_in' => Carbon::parse('09:00:00')->subMinutes(rand(1, 55)),
                        'check_out' => Carbon::parse('18:00:00'),
                    ]);
                }

            }
        }
    }
}
