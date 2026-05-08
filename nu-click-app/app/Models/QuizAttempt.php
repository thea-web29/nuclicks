<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'started_at',
        'completed_at',
        'score',
        'answers',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'answers' => 'array', // Automatically cast JSON to array
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Check if quiz attempt is completed
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    // Get percentage score
    public function getPercentageAttribute()
    {
        if ($this->quiz && $this->quiz->total_points > 0) {
            return round(($this->score / $this->quiz->total_points) * 100, 2);
        }
        return 0;
    }

    // Get time taken to complete quiz
    public function getTimeTakenAttribute()
    {
        if ($this->started_at && $this->completed_at) {
            return $this->started_at->diffInMinutes($this->completed_at);
        }
        return null;
    }
}