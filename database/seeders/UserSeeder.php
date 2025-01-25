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
            'txtNIK' => '1',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 2, // ID Department HR
            'txtName' => 'Jane Smith',
            'txtEmail' => 'janesmith@example.com',
            'txtNIK' => '2',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        // Tambahan untuk Department ID 1 (IT)
        User::create([
            'intDepartment_ID' => 1,
            'txtName' => 'Alice Johnson',
            'txtEmail' => 'alicejohnson@example.com',
            'txtNIK' => '3',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 1,
            'txtName' => 'Bob Williams',
            'txtEmail' => 'bobwilliams@example.com',
            'txtNIK' => '4',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 1,
            'txtName' => 'Charlie Brown',
            'txtEmail' => 'charliebrown@example.com',
            'txtNIK' => '5',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 1,
            'txtName' => 'Diana Prince',
            'txtEmail' => 'dianaprince@example.com',
            'txtNIK' => '6',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        // Tambahan untuk Department ID 2 (HR)
        User::create([
            'intDepartment_ID' => 2,
            'txtName' => 'Ethan Hunt',
            'txtEmail' => 'ethanhunt@example.com',
            'txtNIK' => '7',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 2,
            'txtName' => 'Fiona Gallagher',
            'txtEmail' => 'fionagallagher@example.com',
            'txtNIK' => '8',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 2,
            'txtName' => 'George Michael',
            'txtEmail' => 'georgemichael@example.com',
            'txtNIK' => '9',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'L',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        User::create([
            'intDepartment_ID' => 2,
            'txtName' => 'Hannah Baker',
            'txtEmail' => 'hannahbaker@example.com',
            'txtNIK' => '10',
            'txtPassword' => Hash::make('kalbemorinaga'),
            'txtGender' => 'P',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
