<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'txtDepartment' => 'IT Department',
            'txtShortName' => 'IT',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);

        Department::create([
            'txtDepartment' => 'HR Department',
            'txtShortName' => 'HR',
            'txtInsertedBy' => 'admin',
            'dtmInserted' => now(),
        ]);
    }
}
