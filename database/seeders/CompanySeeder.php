<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run(): void
    {
        Company::create([
            'name' => 'SolPago S.A.',
            'document_type' => 1,
            'document_number' => '123456789',
            'id_user' => 1,
            'status' => 1,
        ]);

        Company::create([
            'name' => 'Tech Innovators Ltd.',
            'document_type' => 2,
            'document_number' => '987654321',
            'id_user' => 2,
            'status' => 1,
        ]);

        Company::create([
            'name' => 'Green Energy Co.',
            'document_type' => 3,
            'document_number' => '192837465',
            'id_user' => 3,
            'status' => 0,
        ]);

        Company::create([
            'name' => 'HealthFirst Inc.',
            'document_type' => 4,
            'document_number' => '564738291',
            'id_user' => 4,
            'status' => 1,
        ]);

        Company::create([
            'name' => 'EduTech Solutions',
            'document_type' => 5,
            'document_number' => '675849302',
            'id_user' => 5,
            'status' => 0,
        ]);
    }
}
