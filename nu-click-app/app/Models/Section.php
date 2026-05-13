<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'year_level',
        'academic_year',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function department()
    {
        return $this->hasOneThrough(
            Department::class,
            Program::class,
            'id',
            'id',
            'program_id',
            'department_id'
        );
    }

    public function subjects()
    {
        return $this->hasMany(Course::class, 'section_id');
    }

    public function facultySubjectAssignments()
    {
        return $this->hasMany(FacultySubjectAssignment::class, 'section_id');
    }

    public function students()
    {
        return User::where('role', 'student')
            ->where('program_id', $this->program_id)
            ->where('section', $this->name);
    }

    public function getAssignedFacultyCountAttribute(): int
    {
        return FacultySubjectAssignment::where('section_id', $this->id)
            ->distinct('faculty_id')
            ->count('faculty_id');
    }
}
