<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Office;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@lnu.edu.ph'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Create sample offices
        $office1 = Office::create([
            'office_name' => 'Computer Science Department',
            'college' => 'College of Computer Studies'
        ]);

        $office2 = Office::create([
            'office_name' => 'Mathematics Department',
            'college' => 'College of Arts and Sciences'
        ]);

        // Create sample teachers
        $teachers = [
            [
                'email' => 'juan.delacruz@lnu.edu.ph',
                'name' => 'Dr. Juan Dela Cruz',
                'office_id' => $office1->id,
                'specialization' => 'Software Engineering',
                'course' => 'Bachelor of Science in Computer Science',
                'educational_background' => 'PhD in Computer Science, MS in Information Technology, BS in Computer Science',
                'subjects_taught' => 'Data Structures, Algorithms, Web Programming, Database Systems',
            ],
            [
                'email' => 'maria.santos@lnu.edu.ph',
                'name' => 'Dr. Maria Santos',
                'office_id' => $office2->id,
                'specialization' => 'Pure Mathematics',
                'course' => 'Bachelor of Science in Mathematics',
                'educational_background' => 'PhD in Mathematics, MS in Applied Mathematics, BS in Mathematics',
                'subjects_taught' => 'Calculus, Linear Algebra, Number Theory, Abstract Algebra',
            ],
            [
                'email' => 'pedro.garcia@lnu.edu.ph',
                'name' => 'Prof. Pedro Garcia',
                'office_id' => $office1->id,
                'specialization' => 'Network Security',
                'course' => 'Bachelor of Science in Information Technology',
                'educational_background' => 'MS in Information Security, BS in Computer Engineering',
                'subjects_taught' => 'Network Administration, Cybersecurity, System Administration',
            ]
        ];

        foreach ($teachers as $teacherData) {
            $teacher = User::firstOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['name'],
                    'password' => Hash::make('password'),
                    'role' => 'teacher'
                ]
            );

            // Create or update profile
            Profile::updateOrCreate(
                ['user_id' => $teacher->id],
                [
                    'user_id' => $teacher->id,
                    'office_id' => $teacherData['office_id'],
                    'specialization' => $teacherData['specialization'],
                    'educational_background' => $teacherData['educational_background'],
                    'researches' => 'Research interests in ' . $teacherData['specialization'],
                    'subjects_taught' => $teacherData['subjects_taught'],
                    'contact_number' => '+63 ' . rand(912000000, 999999999),
                    'course' => $teacherData['course'],
                    'social_links' => [
                        'facebook' => 'https://facebook.com/' . strtolower(str_replace(' ', '.', $teacherData['name'])),
                        'linkedin' => 'https://linkedin.com/in/' . strtolower(str_replace(' ', '-', $teacherData['name']))
                    ]
                ]
            );
        }

        $this->command->info('Sample data created successfully!');
        $this->command->info('Admin Login: admin@lnu.edu.ph / password');
        $this->command->info('Teacher Logins (password is "password" for all accounts):');
        $this->command->info('1. juan.delacruz@lnu.edu.ph - Dr. Juan Dela Cruz (Computer Science)');
        $this->command->info('2. maria.santos@lnu.edu.ph - Dr. Maria Santos (Mathematics)');
        $this->command->info('3. pedro.garcia@lnu.edu.ph - Prof. Pedro Garcia (Information Technology)');
    }
}
