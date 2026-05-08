<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'original_name',
        'type',
        'parent_id',
        'path',
        'mime_type',
        'size',
        'description',
        'uploaded_by',
        'faculty_id',
        'archived_at',
    ];

    protected $casts = [
        'archived_at' => 'datetime',
    ];

    public function folder()
    {
        return $this->belongsTo(AdminFile::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AdminFile::class, 'parent_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function facultyUploader()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    public function getSizeForHumansAttribute(): string
    {
        if (!$this->size) {
            return '—';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = (float) $this->size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }
}
