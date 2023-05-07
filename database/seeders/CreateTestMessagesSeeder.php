<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTestMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'message' => 'Добрый день.',
            'ticket' => 1,
            'created_by' => 4,
        ]);
        Message::create([
            'message' => 'Не могу подключиться к удаленному рабочему столу',
            'ticket' => 1,
            'created_by' => 4,
        ]);
    }
}
