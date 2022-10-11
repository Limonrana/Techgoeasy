<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['key', 'value'];

    /**
     * This static function that are find option field.
     *
     * @var array
     */
    public static function getSetting(string $key)
    {
        return self::where('key', $key)->first();
    }
}
