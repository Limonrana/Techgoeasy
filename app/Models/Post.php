<?php

namespace App\Models;

use App\Traits\HasCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasCreatedUpdatedBy;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'alt_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'visibility',
        'created_by',
        'updated_by',
        'is_featured'
    ];

    /**
     * Get Next Post Attribute
     *
     * @return Post
     */
    public function getNextAttribute()
    {
        return static::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }

    /**
     * Get Previous Post Attribute
     *
     * @return Post
     */
    public  function getPreviousAttribute()
    {
        return static::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }

    /**
     * This Model relationship with Category Model.
     *
     * @function belongsTo
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * This Model relationship with Tag Model.
     *
     * @function belongsTo
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
