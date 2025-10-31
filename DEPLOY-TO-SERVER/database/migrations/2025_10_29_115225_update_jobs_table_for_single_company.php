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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['country', 'city', 'address']);
            $table->string('work_location')->after('deadline');
            $table->string('office_location')->after('work_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['work_location', 'office_location']);
            $table->string('country')->after('deadline');
            $table->string('city')->after('country');
            $table->text('address')->after('city');
        });
    }
};
