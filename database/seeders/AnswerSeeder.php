<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Answer::create([
            'intQuestion_ID' => 1, // ID Question: What is the capital of France?
            'txtAnswer' => 'Paris',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        Answer::create([
            'intQuestion_ID' => 1, // ID Question: What is the capital of France?
            'txtAnswer' => 'London',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        Answer::create([
            'intQuestion_ID' => 2, // ID Question: What is the largest planet?
            'txtAnswer' => 'Jupiter',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        Answer::create([
            'intQuestion_ID' => 2, // ID Question: What is the largest planet?
            'txtAnswer' => 'Saturn',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
