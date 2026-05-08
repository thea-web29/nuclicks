<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'student_id',
        'course_id',
        'rating',
        'teaching_quality',
        'communication',
        'preparedness',
        'fairness',
        'comment',
        'is_anonymous',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'rating' => 'decimal:2',
        'teaching_quality' => 'decimal:2',
        'communication' => 'decimal:2',
        'preparedness' => 'decimal:2',
        'fairness' => 'decimal:2',
    ];

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
