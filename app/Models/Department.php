<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    /**
     * Faculty members belonging to this department.
     */
    public function faculty()
    {
        return $this->hasMany(User::class, 'department_id');
    }
}