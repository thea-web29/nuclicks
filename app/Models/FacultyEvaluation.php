<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

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

    protected static function booted(): void
    {
        static::created(function (FacultyEvaluation $evaluation) {
            try {
                $facultyName = optional($evaluation->faculty)->name ?? 'a faculty member';
                $courseName = optional($evaluation->course)->name ?? 'a course';

                $admins = User::where('role', 'admin')
                    ->where('status', 'active')
                    ->get();

                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'faculty_evaluation',
                        'title' => 'New Faculty Evaluation Submitted',
                        'message' => "A student submitted a faculty evaluation for {$facultyName} in {$courseName}.",
                        'link' => route('admin.faculty-evaluations'),
                        'is_read' => false,
                    ]);
                }
            } catch (Throwable $e) {
                report($e);
            }
        });
    }

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