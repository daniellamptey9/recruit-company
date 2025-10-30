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
            $table->string('resume_path')->nullable();
            $table->text('resume_summary')->nullable();
            $table->text('resume_education')->nullable();
            $table->text('resume_experience')->nullable();
            $table->text('resume_skills')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'resume_path',
                'resume_summary',
                'resume_education',
                'resume_experience',
                'resume_skills',
            ]);
        });
    }
};
