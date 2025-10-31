<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@superio.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create sample candidate
        User::create([
            'name' => 'John Candidate',
            'email' => 'candidate@superio.com',
            'password' => Hash::make('password'),
            'role' => 'candidate',
        ]);

        // Create additional test users
        User::factory(5)->create([
            'role' => 'candidate',
        ]);

        // Seed company data
        $this->call(CompanySeeder::class);
        
        // Seed job data
        $this->call(JobSeeder::class);
    }
}
