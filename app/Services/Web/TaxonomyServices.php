<?php

namespace App\Services\Web;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TaxonomyServices
{
    /*
     * Var $blogPosts
     */
    private $blogPosts;

    /**
     * Get the category data from to database.
     *
     * @param  string $slug
     * @return Model
     */
    public function getCategory(string $slug) : Model
    {
       $this->blogPosts = Category::with(['posts'])->where('slug', $slug)->first();
       return $this->blogPosts;
    }

    /**
     * Get the tag data from to database.
     *
     * @param  string $slug
     * @return Model
     */
    public function getTag(string $slug) : Model
    {
        $this->blogPosts = Tag::with(['posts'])->where('slug', $slug)->first();
        return $this->blogPosts;
    }

    /**
     * Get the category data from to database.
     *
     * @param  int $per_page
     * @return LengthAwarePaginator
     */
    public function getPosts(int $per_page) : LengthAwarePaginator
    {
        $posts = $this->blogPosts->posts->paginate($per_page);
        return $posts;
    }
}
