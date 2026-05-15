<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'student_id',
        'faculty_id',
        'department',
        'department_id',
        'program_id',
        'year_level',
        'section',
        'specialization',
        'bio',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role check methods
    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isFaculty()
    {
        return $this->role === 'faculty';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function departmentRel()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    // Course relationships
    public function courses()
    {
        if ($this->isFaculty()) {
            return $this->hasMany(Course::class, 'faculty_id');
        }
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
                    ->withPivot('status', 'grade')
                    ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

    // Teaching courses (for faculty)
    public function teachingCourses()
    {
        if ($this->isFaculty()) {
            return $this->hasMany(Course::class, 'faculty_id');
        }
        return null;
    }

    // Get enrolled courses count
    public function getEnrolledCoursesCountAttribute()
    {
        if ($this->isStudent()) {
            return $this->courses()->count();
        }
        return 0;
    }

    // Get completed quizzes count
    public function getCompletedQuizzesCountAttribute()
    {
        return $this->quizAttempts()
                    ->whereNotNull('completed_at')
                    ->count();
    }

    // Get average quiz score
    public function getAverageQuizScoreAttribute()
    {
        return $this->quizAttempts()
                    ->whereNotNull('completed_at')
                    ->avg('score') ?? 0;
    }
}