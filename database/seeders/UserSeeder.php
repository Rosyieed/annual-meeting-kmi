<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'intDepartment_ID' => 1, // ID Department IT
            'txtName' => 'John Doe',
            'txtEmail' => 'johndoe@example.com',
            'txtNIK' => '123456789',
            'txtPassword' => Hash::make('12345678'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 2, // ID Department HR
            'txtName' => 'Jane Smith',
            'txtEmail' => 'janesmith@example.com',
            'txtNIK' => '987654321',
            'txtPassword' => Hash::make('12345678'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
