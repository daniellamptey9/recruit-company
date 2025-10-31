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
        Schema::create('candidate_resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cv_file')->nullable(); // CV file path
            $table->string('resume_file'); // Resume file path (required)
            $table->text('professional_summary')->nullable();
            $table->text('education')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('key_skills')->nullable();
            $table->boolean('is_active')->default(true); // To mark current resume
            $table->timestamps();
            
            // Ensure one user can have multiple resumes but only one active
            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_resumes');
    }
};
