<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyData extends Seeder
{

    public function run(): void
    {
        // company data
        \App\Models\CompanyData::create([
            'company_name' => 'Goody',
            'company_email' => 'goody@gmail.com',
            'company_phone' => '09794257469',
            'company_address' => 'Hmawbi,Phugyi',
            'contact_person' => 'Goody',
            'office_start_time' => '09:00:00',
            'office_end_time' => '06:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => "13:00:00",
        ]);
    }
}
