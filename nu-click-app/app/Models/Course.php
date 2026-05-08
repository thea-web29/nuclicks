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
        'join_code',
        'is_active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationship with faculty (User)
    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    // Many-to-many relationship with students through enrollments
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

    // Helper methods
    public function getEnrolledStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    public function getTotalQuizzesAttribute()
    {
        return $this->quizzes()->count();
    }
    
    public function getFacultyNameAttribute()
    {
        return $this->faculty ? $this->faculty->name : 'Not assigned';
    }
}