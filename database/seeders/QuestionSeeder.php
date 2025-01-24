<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'txtQuestion' => 'What is the capital of France?',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        Question::create([
            'txtQuestion' => 'What is the largest planet in our solar system?',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
