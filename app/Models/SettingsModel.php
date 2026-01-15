<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'type',
    ];
    
    private function valueTyped()
    {
        return match ($this->type) {
            'integer' => (int)$this->value,
            'float' => (float)$this->value,
            'bool' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            default => $this->value,
        };
    }

    static public function getValueByKey($key)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->valueTyped() : null;
    }

    static public function setValueByKey($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
