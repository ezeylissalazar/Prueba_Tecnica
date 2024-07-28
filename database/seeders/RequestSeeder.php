<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::create([
            'id_user' => 1,
            'status' => 0,
        ]);
        Request::create([
            'id_user' => 2,
            'status' => 2,
        ]);
        Request::create([
            'id_user' => 3,
            'status' => 1,
        ]);
    }
}
