<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                try {
                    $table->dropForeign(['faculty_id']);
                } catch (\Throwable $e) {
                    // Foreign key may already be missing depending on local schema state.
                }
            }
        });

        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                $table->foreignId('faculty_id')
                    ->nullable()
                    ->change();
            }
        });

        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                try {
                    $table->foreign('faculty_id')
                        ->references('id')
                        ->on('users')
                        ->nullOnDelete();
                } catch (\Throwable $e) {
                    // Constraint may already exist depending on previous migration attempts.
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                try {
                    $table->dropForeign(['faculty_id']);
                } catch (\Throwable $e) {
                    // Ignore if constraint does not exist.
                }
            }
        });

        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                $table->foreignId('faculty_id')
                    ->nullable(false)
                    ->change();
            }
        });

        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'faculty_id')) {
                try {
                    $table->foreign('faculty_id')
                        ->references('id')
                        ->on('users')
                        ->cascadeOnDelete();
                } catch (\Throwable $e) {
                    // Ignore if already exists.
                }
            }
        });
    }
};
