<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Enrollments table
        if (!Schema::hasTable('enrollments')) {
            Schema::create('enrollments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('course_id')->constrained()->onDelete('cascade');
                $table->string('status')->default('active');
                $table->decimal('grade', 5, 2)->nullable();
                $table->timestamp('enrolled_at')->useCurrent();
                $table->timestamps();
                
                $table->unique(['student_id', 'course_id']);
                $table->index('status');
            });
        }

        // Quiz attempts table
        if (!Schema::hasTable('quiz_attempts')) {
            Schema::create('quiz_attempts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
                $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
                $table->integer('score')->default(0);
                $table->timestamp('started_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->string('status')->default('in_progress');
                $table->timestamps();
                
                $table->index(['quiz_id', 'student_id']);
                $table->index('status');
            });
        }

        // Quiz answers table
        if (!Schema::hasTable('quiz_answers')) {
            Schema::create('quiz_answers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('quiz_attempt_id')->constrained()->onDelete('cascade');
                $table->foreignId('question_id')->constrained()->onDelete('cascade');
                $table->text('answer')->nullable();
                $table->integer('points_earned')->default(0);
                $table->boolean('is_correct')->default(false);
                $table->timestamps();
                
                $table->index('quiz_attempt_id');
            });
        }

        // Course materials table
        if (!Schema::hasTable('course_materials')) {
            Schema::create('course_materials', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('file_path')->nullable();
                $table->string('type')->default('file'); // file, video, link, etc.
                $table->integer('order')->default(0);
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // Activity logs table (if not exists)
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->string('action');
                $table->text('description');
                $table->string('ip_address')->nullable();
                $table->string('user_agent')->nullable();
                $table->timestamps();
                
                $table->index('action');
                $table->index('created_at');
            });
        }

        // Course faculty pivot table
        if (!Schema::hasTable('course_faculty')) {
            Schema::create('course_faculty', function (Blueprint $table) {
                $table->id();
                $table->foreignId('course_id')->constrained()->onDelete('cascade');
                $table->foreignId('faculty_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['course_id', 'faculty_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('course_faculty');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('course_materials');
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('enrollments');
    }
};