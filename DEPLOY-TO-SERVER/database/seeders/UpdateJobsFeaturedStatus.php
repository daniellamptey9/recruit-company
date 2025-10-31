<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class UpdateJobsFeaturedStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update first 3 jobs to be featured
        Job::where('is_active', true)
            ->limit(3)
            ->update(['is_featured' => true]);

        // Ensure all jobs are active
        Job::where('is_active', false)
            ->update(['is_active' => true]);
    }
}