<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin user
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found. Please run the main seeder first.');
            return;
        }

        $jobs = [
            [
                'title' => 'Senior Software Developer',
                'description' => 'We are looking for an experienced Senior Software Developer to join our dynamic team. You will be responsible for developing high-quality software solutions, leading technical projects, and mentoring junior developers. The ideal candidate should have strong experience in modern web technologies and a passion for clean, maintainable code.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['IT', 'Digital&Creative'],
                'job_type' => 'Full-time',
                'salary_range' => '$90,000 - $120,000',
                'career_level' => 'Senior Level',
                'experience' => '5-10 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(30),
                'work_location' => 'Hybrid',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Marketing Manager',
                'description' => 'Join our marketing team as a Marketing Manager and lead our digital marketing initiatives. You will develop and execute marketing strategies, manage campaigns, analyze performance metrics, and collaborate with cross-functional teams. We need someone creative, data-driven, and experienced in both traditional and digital marketing channels.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['Management', 'Digital&Creative'],
                'job_type' => 'Full-time',
                'salary_range' => '$70,000 - $90,000',
                'career_level' => 'Mid Level',
                'experience' => '3-5 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(25),
                'work_location' => 'On-site',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'We are seeking a talented Frontend Developer to create amazing user experiences. You will work with modern frameworks like React, Vue.js, and Angular to build responsive, interactive web applications. The role involves collaborating with designers and backend developers to deliver pixel-perfect, high-performance frontend solutions.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['IT', 'Digital&Creative'],
                'job_type' => 'Full-time',
                'salary_range' => '$60,000 - $80,000',
                'career_level' => 'Mid Level',
                'experience' => '1-3 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(20),
                'work_location' => 'Remote',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Data Analyst',
                'description' => 'Looking for a skilled Data Analyst to help us make data-driven decisions. You will collect, process, and analyze large datasets to identify trends, patterns, and insights. The role requires strong analytical skills, proficiency in SQL and Python, and experience with data visualization tools like Tableau or Power BI.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['IT', 'Management'],
                'job_type' => 'Full-time',
                'salary_range' => '$65,000 - $85,000',
                'career_level' => 'Mid Level',
                'experience' => '2-4 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(35),
                'work_location' => 'Hybrid',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Customer Success Manager',
                'description' => 'Join our customer success team and help our clients achieve their goals. You will be responsible for building strong relationships with customers, ensuring their success with our products, and identifying opportunities for growth. The ideal candidate should have excellent communication skills and a customer-first mindset.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['Management', 'Retail'],
                'job_type' => 'Full-time',
                'salary_range' => '$55,000 - $75,000',
                'career_level' => 'Mid Level',
                'experience' => '2-4 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(28),
                'work_location' => 'On-site',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'We need a DevOps Engineer to help us scale our infrastructure and improve our deployment processes. You will work with cloud platforms like AWS or Azure, implement CI/CD pipelines, and ensure our systems are secure and reliable. Experience with Docker, Kubernetes, and infrastructure as code is essential.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['IT'],
                'job_type' => 'Full-time',
                'salary_range' => '$80,000 - $110,000',
                'career_level' => 'Senior Level',
                'experience' => '3-6 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(40),
                'work_location' => 'Hybrid',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'UX/UI Designer',
                'description' => 'Looking for a creative UX/UI Designer to design intuitive and engaging user experiences. You will work closely with product managers and developers to create wireframes, prototypes, and high-fidelity designs. Proficiency in Figma, Adobe Creative Suite, and user research methodologies is required.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['Digital&Creative', 'IT'],
                'job_type' => 'Full-time',
                'salary_range' => '$60,000 - $85,000',
                'career_level' => 'Mid Level',
                'experience' => '2-5 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(22),
                'work_location' => 'Hybrid',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Sales Representative',
                'description' => 'Join our sales team as a Sales Representative and help us grow our business. You will identify new business opportunities, build relationships with potential clients, and close deals. The role requires strong communication skills, persistence, and a results-driven attitude. Experience in B2B sales is preferred.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['Retail', 'Management'],
                'job_type' => 'Full-time',
                'salary_range' => '$45,000 - $65,000',
                'career_level' => 'Entry Level',
                'experience' => '0-2 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'High School',
                'deadline' => now()->addDays(18),
                'work_location' => 'On-site',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'We are seeking a Backend Developer to build robust server-side applications. You will work with technologies like Node.js, Python, or Java to develop APIs, manage databases, and ensure system scalability. Experience with microservices architecture and cloud platforms is a plus.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['IT'],
                'job_type' => 'Full-time',
                'salary_range' => '$70,000 - $95,000',
                'career_level' => 'Mid Level',
                'experience' => '3-5 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(32),
                'work_location' => 'Remote',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Project Manager',
                'description' => 'Looking for an experienced Project Manager to lead our development projects. You will coordinate with cross-functional teams, manage timelines and budgets, and ensure successful project delivery. PMP certification and experience with Agile methodologies are highly preferred.',
                'company_email' => $admin->email,
                'contact_person' => $admin->name,
                'categories' => ['Management', 'IT'],
                'job_type' => 'Full-time',
                'salary_range' => '$75,000 - $100,000',
                'career_level' => 'Senior Level',
                'experience' => '5-8 years',
                'gender_preference' => null,
                'industry' => 'Technology',
                'qualification' => 'Bachelor\'s Degree',
                'deadline' => now()->addDays(45),
                'work_location' => 'Hybrid',
                'office_location' => 'Melbourne, VIC',
                'is_active' => true,
                'user_id' => $admin->id,
            ]
        ];

        foreach ($jobs as $jobData) {
            Job::create($jobData);
        }

        $this->command->info('Successfully seeded ' . count($jobs) . ' jobs.');
    }
}