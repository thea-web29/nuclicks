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
        'student_id',
        'faculty_id',
        'department',       // legacy text field (kept for backward compat)
        'department_id',    // FK to departments table (new)
        'year_level',
        'section',
        'program_id',
        'course_id',
        'must_change_password',
        'status',
        'avatar',
        'specialization',
        'qualification',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at'    => 'datetime',
            'password'             => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }

    public function isStudent(): bool { return $this->role === 'student'; }
    public function isFaculty(): bool { return $this->role === 'faculty'; }
    public function isAdmin():   bool { return $this->role === 'admin';   }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function course()
{
    return $this->belongsTo(\App\Models\Course::class);
}
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

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function getEnrolledCoursesCountAttribute(): int
    {
        return $this->isStudent() ? $this->courses()->count() : 0;
    }

    public function getCompletedQuizzesCountAttribute(): int
    {
        return $this->quizAttempts()->whereNotNull('completed_at')->count();
    }

    public function getAverageQuizScoreAttribute(): float
    {
        return $this->quizAttempts()->whereNotNull('completed_at')->avg('score') ?? 0;
    }
}