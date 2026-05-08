<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description'];

    // Subjects (courses) that belong to this program
    public function subjects()
    {
        return $this->hasMany(Course::class);
    }

    // Students enrolled in this program
    public function students()
    {
        return $this->hasMany(User::class, 'program_id');
    }
}