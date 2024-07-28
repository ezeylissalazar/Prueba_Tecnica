<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
 
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Maria Gonzalez',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
        ]);
        $user1->assignRole('user');

        $user2 = User::create([
            'name' => 'Carlos Perez',
            'email' => 'carlos.perez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user2->assignRole('user');

        $user3 = User::create([
            'name' => 'Ana Rodriguez',
            'email' => 'ana.rodriguez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user3->assignRole('user');

        $user4 = User::create([
            'name' => 'Luis Fernandez',
            'email' => 'luis.fernandez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user4->assignRole('user');

        $user5 = User::create([
            'name' => 'Elena Martinez',
            'email' => 'elena.martinez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user5->assignRole('user');

        $user6 = User::create([
            'name' => 'Javier Lopez',
            'email' => 'javier.lopez@example.com',
            'password' => Hash::make('password'),
        ]);
        $user6->assignRole('user');
    }
}
