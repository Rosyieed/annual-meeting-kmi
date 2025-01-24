<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAnswer;

class UserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAnswer::create([
            'intUser_ID' => 1, // ID User: John Doe
            'intQuestion_ID' => 1, // ID Question: What is the capital of France?
            'intAnswer_ID' => 1, // ID Answer: Paris
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        UserAnswer::create([
            'intUser_ID' => 2, // ID User: Jane Smith
            'intQuestion_ID' => 1, // ID Question: What is the capital of France?
            'intAnswer_ID' => 2, // ID Answer: London
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        UserAnswer::create([
            'intUser_ID' => 1, // ID User: John Doe
            'intQuestion_ID' => 2, // ID Question: What is the largest planet?
            'intAnswer_ID' => 3, // ID Answer: Jupiter
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        UserAnswer::create([
            'intUser_ID' => 2, // ID User: Jane Smith
            'intQuestion_ID' => 2, // ID Question: What is the largest planet?
            'intAnswer_ID' => 4, // ID Answer: Saturn
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
