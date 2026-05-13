<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    /**
     * Legacy direct faculty profile assignment.
     * Kept for backward compatibility only.
     */
    public function faculty()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    /**
     * Programs/Courses under this department.
     */
    public function programs()
    {
        return $this->hasMany(Program::class, 'department_id');
    }

    /**
     * Sections under this department through programs/courses.
     */
    public function sections()
    {
        return $this->hasManyThrough(Section::class, Program::class, 'department_id', 'program_id');
    }

    /**
     * Faculty subject assignments directly tagged to this department.
     */
    public function facultySubjectAssignments()
    {
        return $this->hasMany(FacultySubjectAssignment::class, 'department_id');
    }

    /**
     * Computed faculty count based on unique faculty assigned to subjects/sections
     * under this department, not direct user profile department_id.
     */
    public function getAssignedFacultyCountAttribute(): int
    {
        return FacultySubjectAssignment::where('department_id', $this->id)
            ->distinct('faculty_id')
            ->count('faculty_id');
    }

    /**
     * Fallback count using current courses/subjects table for older records.
     */
    public function getLegacyAssignedFacultyCountAttribute(): int
    {
        $programIds = $this->programs()->pluck('id');

        if ($programIds->isEmpty()) {
            return 0;
        }

        return Course::whereIn('program_id', $programIds)
            ->whereNotNull('faculty_id')
            ->distinct('faculty_id')
            ->count('faculty_id');
    }
}
