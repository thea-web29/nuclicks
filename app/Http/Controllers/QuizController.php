<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\Course;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of quizzes for the authenticated user's enrolled courses.
     */
    public function index()
    {
        // TODO: implement quiz listing
    }

    /**
     * Show a specific quiz.
     */
    public function show($id)
    {
        // TODO: implement quiz display
    }

    /**
     * Start a quiz attempt.
     */
    public function start(Request $request, $id)
    {
        // TODO: implement quiz start
    }

    /**
     * Submit a quiz attempt.
     */
    public function submit(Request $request, $id)
    {
        // TODO: implement quiz submission
    }

    /**
     * Show the results of a completed quiz attempt.
     */
    public function results($attemptId)
    {
        // TODO: implement results display
    }
}