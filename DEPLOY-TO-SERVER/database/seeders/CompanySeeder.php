<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Superio Recruitment Solutions',
            'email' => 'info@superio.com',
            'phone' => '+1 (555) 123-4567',
            'website' => 'https://www.superio.com',
            'established_since' => '2020-04-06',
            'team_size' => '50 - 100',
            'about' => 'Superio Recruitment Solutions is a leading talent acquisition company specializing in connecting top-tier professionals with innovative companies. We have spent several years working on recruitment strategies and have had moderate success in placing candidates in various industries. Our team manages a comprehensive database of qualified professionals and works closely with both job seekers and employers to create meaningful career connections. We specialize in digital and creative roles, human resources positions, and management-level placements. Our mission is to eliminate the challenges present in traditional recruitment processes by leveraging technology and personalized service.',
            'logo' => null, // Will be uploaded via the form
            
            // Social Media
            'facebook' => 'https://www.facebook.com/superio',
            'twitter' => 'https://www.twitter.com/superio',
            'linkedin' => 'https://www.linkedin.com/company/superio',
            'google_plus' => null,
            
            // Contact Information
            'country' => 'Australia',
            'city' => 'Melbourne',
            'address' => '329 Queensberry Street, North Melbourne VIC 3051, Australia',
        ]);
    }
}