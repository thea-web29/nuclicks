<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'options',
        'correct_answer',
        'points',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function isCorrect($answer)
    {
        return $this->correct_answer === $answer;
    }

    public function getOptionsListAttribute()
    {
        if ($this->question_type === 'mcq' && $this->options) {
            return $this->options;
        }
        return [];
    }

    public function getTrueFalseOptionsAttribute()
    {
        if ($this->question_type === 'true_false') {
            return ['True', 'False'];
        }
        return [];
    }
}