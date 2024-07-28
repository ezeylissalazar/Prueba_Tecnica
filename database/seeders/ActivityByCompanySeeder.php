<?php

namespace Database\Seeders;

use App\Models\ActivityByCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityByCompanySeeder extends Seeder
{
  
    public function run(): void
    {
        ActivityByCompany::create([
            'id_company' => 1,
            'id_activity' => 1,
        ]);
        ActivityByCompany::create([
            'id_company' => 1,
            'id_activity' => 3,
        ]);
        ActivityByCompany::create([
            'id_company' => 1,
            'id_activity' => 6,
        ]);

        ActivityByCompany::create([
            'id_company' => 2,
            'id_activity' => 2,
        ]);
        ActivityByCompany::create([
            'id_company' => 2,
            'id_activity' => 4,
        ]);
        ActivityByCompany::create([
            'id_company' => 2,
            'id_activity' => 5,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            ActivityByCompany::create([
                'id_company' => 3,
                'id_activity' => $i,
            ]);
        }
    }
}
