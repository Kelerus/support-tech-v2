<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateTestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'Иван',
            'email' => 'ivan_tech@email.com',
            'password' => Hash::make('tech'),
        ]);
        User::create([
            'name' => 'Глеб',
            'email' => 'gleb_tech@email.com',
            'password' => Hash::make('tech'),
        ]);
        User::create([
            'name' => 'Кирилл',
            'email' => 'kirill_user@email.com',
            'password' => Hash::make('user'),
        ]);
    }
}
