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
            'message' => 'Добрый день. Это тестовое сообщение',
            'ticket' => 1,
            'created_by' => 1,
        ]);
        Message::create([
            'message' => 'Не могу решить проблему с оформлением документа можете помочь',
            'ticket' => 1,
            'created_by' => 1,
        ]);
    }
}
