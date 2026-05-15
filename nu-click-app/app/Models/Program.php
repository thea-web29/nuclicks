<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'code',
        'description',
    ];

    /**
     * Program/Course belongs to one Department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Existing subject records are stored in the courses table.
     * In the UI these should be treated as Subjects.
     */
    public function subjects()
    {
        return $this->hasMany(Course::class, 'program_id');
    }

    /**
     * Students enrolled in this program/course.
     */
    public function students()
    {
        return $this->hasMany(User::class, 'program_id');
    }

    /**
     * Sections under this program/course.
     */
    public function sections()
    {
        return $this->hasMany(Section::class, 'program_id');
    }

    public function facultySubjectAssignments()
    {
        return $this->hasMany(FacultySubjectAssignment::class, 'program_id');
    }

    public function getAssignedFacultyCountAttribute(): int
    {
        return FacultySubjectAssignment::where('program_id', $this->id)
            ->distinct('faculty_id')
            ->count('faculty_id');
    }
}
