<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $courseCode;
    public $courseName;
    public $teacherName;

    public function __construct($courseCode, $courseName, $teacherName)
    {
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->teacherName = $teacherName;
    }

    public function build()
    {
        return $this->subject('Your Class Code for ' . $this->courseName)
                    ->view('emails.course_code');
    }
}