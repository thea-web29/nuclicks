<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'duration_minutes',
        'max_attempts',
        'total_points',
        'start_date',
        'end_date',
    ];

    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Check if quiz is currently active
    public function isActive()
    {
        $now = now();
        return (!$this->start_date || $this->start_date <= $now) && 
               (!$this->end_date || $this->end_date >= $now);
    }

    // Check if quiz has started
    public function hasStarted()
    {
        return !$this->start_date || $this->start_date <= now();
    }

    // Check if quiz has ended
    public function hasEnded()
    {
        return $this->end_date && $this->end_date <= now();
    }

    // Get total points from all questions
    public function calculateTotalPoints()
    {
        $this->total_points = $this->questions()->sum('points');
        $this->save();
        return $this->total_points;
    }

    // Get student's best attempt
    public function getBestAttempt($studentId)
    {
        return $this->attempts()
                    ->where('student_id', $studentId)
                    ->whereNotNull('completed_at')
                    ->orderBy('score', 'desc')
                    ->first();
    }

    // Get student's average score
    public function getAverageScoreAttribute()
    {
        return $this->attempts()
                    ->whereNotNull('completed_at')
                    ->avg('score') ?? 0;
    }
}