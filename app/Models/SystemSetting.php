<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'description',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }
        
        $value = $setting->value;
        
        switch ($setting->type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'number':
                return is_numeric($value) ? (float) $value : $default;
            case 'json':
                return json_decode($value, true) ?? $default;
            default:
                return $value;
        }
    }
    
    public static function setValue($key, $value, $group = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['group' => $group, 'value' => $value]
        );
    }
}