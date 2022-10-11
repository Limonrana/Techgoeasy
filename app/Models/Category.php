<?php

namespace App\Models;

use App\Traits\HasCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'created_by',
        'updated_by'
    ];

    /**
     * This Model relationship with Post Model.
     *
     * @function belongsTo
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * This static function that are find option field.
     *
     * @var array
     */
    public static function getTopCategories(int $limit)
    {
        return self::withCount(['posts'])->orderByDesc('posts_count')->limit($limit)->get();
    }
}
