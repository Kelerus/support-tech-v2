<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTestTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'name' => 'Настройка удаленного доступа',
            'description' => 'Не могу подключиться к удаленному рабочему столу',
            'created_by' => 4,
        ]);
    }
}
