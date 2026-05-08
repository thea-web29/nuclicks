<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@nuclicks.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@nuclicks.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Faculty
        User::updateOrCreate(
            ['email' => 'faculty@nuclicks.com'],
            [
                'name' => 'Dr. John Smith',
                'email' => 'faculty@nuclicks.com',
                'password' => Hash::make('password'),
                'role' => 'faculty',
                'faculty_id' => 'FAC001',
                'department' => 'Computer Science',
            ]
        );

        // Create Student
        User::updateOrCreate(
            ['email' => 'student@nuclicks.com'],
            [
                'name' => 'Jane Doe',
                'email' => 'student@nuclicks.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => 'STU001',
                'department' => 'Computer Science',
                'year_level' => 3,
            ]
        );

        $this->command->info('Users created successfully!');
    }
}