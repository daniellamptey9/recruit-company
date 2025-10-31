<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Information Technology',
                'slug' => 'information-technology',
                'description' => 'Software development, programming, system administration, and IT support roles',
                'color' => '#1967D2',
                'icon' => 'la la-laptop-code',
                'sort_order' => 1,
            ],
            [
                'name' => 'Digital & Creative',
                'slug' => 'digital-creative',
                'description' => 'Design, marketing, content creation, and digital media roles',
                'color' => '#FF6B6B',
                'icon' => 'la la-palette',
                'sort_order' => 2,
            ],
            [
                'name' => 'Management',
                'slug' => 'management',
                'description' => 'Leadership, project management, and executive positions',
                'color' => '#4ECDC4',
                'icon' => 'la la-users-cog',
                'sort_order' => 3,
            ],
            [
                'name' => 'Human Resources',
                'slug' => 'human-resources',
                'description' => 'Recruitment, employee relations, and HR administration',
                'color' => '#45B7D1',
                'icon' => 'la la-user-tie',
                'sort_order' => 4,
            ],
            [
                'name' => 'Healthcare',
                'slug' => 'healthcare',
                'description' => 'Medical, nursing, and healthcare support positions',
                'color' => '#96CEB4',
                'icon' => 'la la-heartbeat',
                'sort_order' => 5,
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Teaching, training, and educational administration',
                'color' => '#FFEAA7',
                'icon' => 'la la-graduation-cap',
                'sort_order' => 6,
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Accounting, banking, and financial services',
                'color' => '#DDA0DD',
                'icon' => 'la la-chart-line',
                'sort_order' => 7,
            ],
            [
                'name' => 'Retail',
                'slug' => 'retail',
                'description' => 'Sales, customer service, and retail management',
                'color' => '#FFB347',
                'icon' => 'la la-shopping-cart',
                'sort_order' => 8,
            ],
            [
                'name' => 'Manufacturing',
                'slug' => 'manufacturing',
                'description' => 'Production, quality control, and manufacturing operations',
                'color' => '#87CEEB',
                'icon' => 'la la-industry',
                'sort_order' => 9,
            ],
            [
                'name' => 'Banking',
                'slug' => 'banking',
                'description' => 'Financial services, investment, and banking operations',
                'color' => '#98D8C8',
                'icon' => 'la la-university',
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        $this->command->info('Successfully seeded ' . count($categories) . ' job categories.');
    }
}
