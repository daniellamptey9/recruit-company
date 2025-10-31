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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('company_email');
            $table->string('contact_person');
            $table->json('categories')->nullable();
            $table->string('job_type');
            $table->string('salary_range');
            $table->string('career_level');
            $table->string('experience');
            $table->string('gender_preference')->nullable();
            $table->string('industry');
            $table->string('qualification')->nullable();
            $table->date('deadline');
            $table->string('work_location');
            $table->string('office_location');
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
