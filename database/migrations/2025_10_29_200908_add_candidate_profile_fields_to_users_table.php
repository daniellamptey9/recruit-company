<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal Information
            $table->string('job_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('experience')->nullable();
            $table->string('age_range')->nullable();
            $table->string('education')->nullable();
            $table->string('languages')->nullable();
            $table->json('categories')->nullable();
            $table->boolean('allow_search')->default(true);
            $table->text('description')->nullable();
            
            // Social Links
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            
            // Contact Information
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'job_title', 'phone', 'website', 'current_salary', 'expected_salary',
                'experience', 'age_range', 'education', 'languages', 'categories',
                'allow_search', 'description', 'facebook', 'twitter', 'linkedin',
                'instagram', 'country', 'city', 'address'
            ]);
        });
    }
};
