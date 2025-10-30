<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->longText('key_responsibilities')->nullable()->after('description');
            $table->longText('skills_experience')->nullable()->after('key_responsibilities');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['key_responsibilities', 'skills_experience']);
        });
    }
};


