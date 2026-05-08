<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = ['user_id', 'otp', 'expires_at', 'used'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return now()->isAfter($this->expires_at);
    }

    public function isValid(): bool
    {
        return !$this->used && !$this->isExpired();
    }
}