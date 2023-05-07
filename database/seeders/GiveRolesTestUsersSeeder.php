<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GiveRolesTestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAdmin = User::find(1);
        $userAdmin->assignRole('admin');
        $userTechOne = User::find(2);
        $userTechOne->assignRole('tech');
        $userTechTwo = User::find(3);
        $userTechTwo->assignRole('tech');
    }
}
