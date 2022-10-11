<?php

namespace App\Services\Web;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Collection;

class HomeBlogServices
{

    /*
     * Var $recentPost
     */
    private $recentPost;

    /**
     * Filter the recent blog post listing from to database.
     *
     * @param  int $take
     * @return HomeBlogServices
     */
    public function getRecentPost(int $take = 6) : HomeBlogServices
    {
        if (!$this->recentPost) {
            $this->recentPost = Post::with(['categories'])->latest('id')->take($take)->get();
        }
        return $this;
    }

    /**
     * Get the category based blog post listing from to database.
     *
     * @param  int $limit
     * @return array
     */
    public function getPostCategoryBased(int $limit = 3) : array
    {
        $posts = [];
        $categories = Category::has('posts', '>=', 3)->limit($limit)->with('posts')->get();
        foreach ($categories as $category) {
            $getPosts = $category->posts->take($limit)->all();
            array_push($posts, ['category' => $category->name, 'slug' => $category->slug, 'items' => collect($getPosts)]);
        }
        return $posts;
    }

    /**
     * Get the featured blog post listing from to database.
     *
     * @param  int $limit
     * @return array | Collection
     */
    public function getFeaturedPost(int $limit = 5)
    {
        return Post::with(['categories'])->where('is_featured', true)
            ->latest('id')->take($limit)->get();
    }

    /**
     * Get the popular blog post listing from to database.
     *
     * @param  int $limit
     * @return array | Collection
     */
    public function getPopularPost(int $limit = 4)
    {
        return Post::with(['categories'])->take($limit)->get();
    }

    /**
     * Get the category listing from to database.
     *
     * @param  int $limit
     * @return array | Collection
     */
    public function getCategories(int $limit = 10)
    {
        return Category::withCount(['posts'])->orderByDesc('posts_count')->take($limit)->get();
    }

    /**
     * Get the tags listing from to database.
     *
     * @param  int $limit
     * @return array | Collection
     */
    public function getTags(int $limit = 15)
    {
        return Tag::withCount(['posts'])->orderByDesc('posts_count')->take($limit)->get();
    }

    /**
     * Take the range of recent blog post listing of the resource.
     *
     * @param  int $value
     * @return Collection
     */
    public function takeRange(int $value) : Collection
    {
        $this->takeRange = $value;
        return $this->recentPost->take($value);
    }

    /**
     * Take the range of recent blog post listing of the resource.
     *
     * @param  int $start
     * @return array | Collection
     */
    public function takeFromRange(int $start)
    {
        return $this->recentPost->filter(function ($value, $key) use ($start) {
            return $key >= $start;
        })->all();
    }

}
