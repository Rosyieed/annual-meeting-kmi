<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'txtGroupName' => 'AKMIL KMI',
            'intLeader_ID' => null,
            'txtInsertedBy' => 'Admin',
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        Group::create([
            'txtGroupName' => 'AKPOL KMI',
            'intLeader_ID' => null,
            'txtInsertedBy' => 'Admin',
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        Group::create([
            'txtGroupName' => 'SIBERSN KMI',
            'intLeader_ID' => null,
            'txtInsertedBy' => 'Admin',
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);
    }
}
