<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'intRole_ID' => 1,
            'txtRole' => 'Admin',
            'txtInsertedBy' => 'Admin',
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);

        Role::create([
            'intRole_ID' => 2,
            'txtRole' => 'User',
            'txtInsertedBy' => 'Admin',
            'dtmInserted' => now(),
            'bitActive' => 1,
        ]);
    }
}
