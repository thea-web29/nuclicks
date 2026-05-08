<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('faculty_evaluations')) {
            Schema::create('faculty_evaluations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('faculty_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('student_id')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete();
                $table->decimal('rating', 3, 2)->default(0);
                $table->decimal('teaching_quality', 3, 2)->nullable();
                $table->decimal('communication', 3, 2)->nullable();
                $table->decimal('preparedness', 3, 2)->nullable();
                $table->decimal('fairness', 3, 2)->nullable();
                $table->text('comment')->nullable();
                $table->boolean('is_anonymous')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_evaluations');
    }
};
