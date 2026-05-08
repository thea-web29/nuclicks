<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Force password change on first login
            $table->boolean('must_change_password')->default(false)->after('remember_token');
            // Student's enrolled section (e.g. A, B, C)
            $table->string('section')->nullable()->after('year_level');
            // Student's degree program
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete()->after('section');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropColumn(['must_change_password', 'section', 'program_id']);
        });
    }
};