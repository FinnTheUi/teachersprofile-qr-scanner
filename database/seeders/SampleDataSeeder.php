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

        // Create sample teacher
        $teacher = User::firstOrCreate(
            ['email' => 'juan.delacruz@lnu.edu.ph'],
            [
                'name' => 'Dr. Juan Dela Cruz',
                'password' => Hash::make('password'),
                'role' => 'teacher'
            ]
        );

        // Create sample profile (only if it doesn't exist)
        if (!$teacher->profile) {
            Profile::create([
            'user_id' => $teacher->id,
            'office_id' => $office1->id,
            'specialization' => 'Software Engineering',
            'educational_background' => 'PhD in Computer Science, MS in Information Technology, BS in Computer Science',
            'researches' => 'Machine Learning Applications in Education, Web Development Best Practices',
            'subjects_taught' => 'Data Structures, Algorithms, Web Programming, Database Systems',
            'contact_number' => '+63 912 345 6789',
            'course' => 'Bachelor of Science in Computer Science',
            'social_links' => [
                'facebook' => 'https://facebook.com/juan.delacruz',
                'linkedin' => 'https://linkedin.com/in/juan-delacruz'
            ]
            ]);
        }

        $this->command->info('Sample data created successfully!');
        $this->command->info('Admin Login: admin@lnu.edu.ph / password');
        $this->command->info('Teacher Login: juan.delacruz@lnu.edu.ph / password');
    }
}
