<?php

namespace Database\Seeders;

use App\Models\TypeActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeActivitySeeder extends Seeder
{

    public function run(): void
    {
        TypeActivity::create(['name' => 'Cattle Raising']);
        TypeActivity::create(['name' => 'Software']);
        TypeActivity::create(['name' => 'Air Transport']);
        TypeActivity::create(['name' => 'Mining']);
        TypeActivity::create(['name' => 'Fishing']);
        TypeActivity::create(['name' => 'Real Estate']);
        TypeActivity::create(['name' => 'Construction']);
        TypeActivity::create(['name' => 'Tourism']);
        TypeActivity::create(['name' => 'Telecommunications']);
        TypeActivity::create(['name' => 'Agriculture']);
        TypeActivity::create(['name' => 'Electricity']);
    }
}
