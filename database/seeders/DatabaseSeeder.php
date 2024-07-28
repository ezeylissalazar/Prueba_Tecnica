<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            RolesSeeder::class,
            PermissionSeeder::class,
            UsersSeeder::class,
            CompanySeeder::class,
            TypeActivitySeeder::class,
            ActivityByCompanySeeder::class,
            RequestSeeder::class,
        ]);
    }
}
