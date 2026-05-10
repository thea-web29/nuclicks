<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'department_id')) {
                $table->foreignId('department_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('departments')
                    ->nullOnDelete();
            }
        });

        if (!Schema::hasTable('sections')) {
            Schema::create('sections', function (Blueprint $table) {
                $table->id();
                $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
                $table->string('name', 100);
                $table->string('year_level', 100)->nullable();
                $table->string('academic_year', 100)->nullable();
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->unique(['program_id', 'name'], 'sections_program_name_unique');
            });
        }

        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'section_id')) {
                $table->foreignId('section_id')
                    ->nullable()
                    ->after('program_id')
                    ->constrained('sections')
                    ->nullOnDelete();
            }
        });

        // Make faculty_id nullable safely. Subjects should be allowed to exist before assigning faculty.
        if (Schema::hasColumn('courses', 'faculty_id')) {
            try {
                DB::statement('ALTER TABLE `courses` MODIFY `faculty_id` BIGINT UNSIGNED NULL');
            } catch (Throwable $e) {
                // Some local DBs may already be nullable or use a different integer type.
                // Continue because the controller no longer clears faculty_id to NULL during profile edits.
            }
        }

        if (!Schema::hasTable('faculty_subject_assignments')) {
            Schema::create('faculty_subject_assignments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('faculty_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
                $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
                $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
                $table->foreignId('subject_id')->constrained('courses')->cascadeOnDelete();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->unique(
                    ['faculty_id', 'program_id', 'section_id', 'subject_id'],
                    'faculty_subject_unique_assignment'
                );
            });
        }

        $this->backfillSectionsFromExistingCourses();
        $this->backfillFacultyAssignmentsFromExistingCourses();
    }

    public function down(): void
    {
        // This repair migration intentionally does not drop data structures.
        // Dropping sections or faculty assignments could destroy academic data.
    }

    private function backfillSectionsFromExistingCourses(): void
    {
        if (!Schema::hasTable('courses') || !Schema::hasTable('sections') || !Schema::hasColumn('courses', 'section_id')) {
            return;
        }

        $courses = DB::table('courses')
            ->whereNotNull('program_id')
            ->whereNotNull('section')
            ->get();

        foreach ($courses as $course) {
            $sectionName = strtoupper(trim((string) $course->section));

            if ($sectionName === '') {
                continue;
            }

            $section = DB::table('sections')
                ->where('program_id', $course->program_id)
                ->where('name', $sectionName)
                ->first();

            if (!$section) {
                $sectionId = DB::table('sections')->insertGetId([
                    'program_id' => $course->program_id,
                    'name' => $sectionName,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $sectionId = $section->id;
            }

            DB::table('courses')->where('id', $course->id)->update([
                'section_id' => $sectionId,
                'section' => $sectionName,
                'updated_at' => now(),
            ]);
        }
    }

    private function backfillFacultyAssignmentsFromExistingCourses(): void
    {
        if (!Schema::hasTable('courses') || !Schema::hasTable('programs') || !Schema::hasTable('faculty_subject_assignments')) {
            return;
        }

        $courses = DB::table('courses')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->whereNotNull('courses.faculty_id')
            ->whereNotNull('courses.program_id')
            ->whereNotNull('courses.section_id')
            ->whereNotNull('programs.department_id')
            ->select(
                'courses.id as subject_id',
                'courses.faculty_id',
                'courses.program_id',
                'courses.section_id',
                'programs.department_id'
            )
            ->get();

        foreach ($courses as $course) {
            DB::table('faculty_subject_assignments')->updateOrInsert(
                [
                    'faculty_id' => $course->faculty_id,
                    'program_id' => $course->program_id,
                    'section_id' => $course->section_id,
                    'subject_id' => $course->subject_id,
                ],
                [
                    'department_id' => $course->department_id,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
};
