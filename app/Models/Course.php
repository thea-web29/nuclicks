<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'credits',
        'faculty_id',
        'program_id',
        'section',
        'join_code',
        'is_active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    // ==================== RELATIONSHIPS ====================

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                    ->where('role', 'student')
                    ->withPivot('status', 'grade')
                    ->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // ==================== HELPERS ====================

    public function getEnrolledStudentsCountAttribute(): int
    {
        return $this->students()->count();
    }

    public function getTotalQuizzesAttribute(): int
    {
        return $this->quizzes()->count();
    }

    public function getFacultyNameAttribute(): string
    {
        return $this->faculty ? $this->faculty->name : 'Not assigned';
    }

    /**
     * Get all students who belong to this subject's program + section.
     * These are the students that will receive emailed join codes.
     */
    public function eligibleStudents()
    {
        return User::where('role', 'student')
            ->where('program_id', $this->program_id)
            ->where('section', $this->section)
            ->get();
    }
}