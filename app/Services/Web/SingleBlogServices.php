<?php

namespace App\Services\Web;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SingleBlogServices
{

    /**
     * Get the single blog post data from to database.
     *
     * @param  string $slug
     * @return Model
     */
    public function execute(string $slug)
    {
        $this->post = Post::with(['categories', 'tags', 'createdBy', 'categories.posts'])->where('slug', $slug)->first();
        return $this->post;
    }

    /**
     * Get the single blog post related post from to database.
     *
     * @return Collection
     */
    public function getRelatedPost() : Collection
    {
        $related_post = collect([]);
        $categories = $this->post->categories;
        foreach ($categories as $category) {
            if ($related_post->count() > 2) break;
            foreach ($category->posts as $post) {
                if ($related_post->count() > 2) {
                    break;
                } else {
                    if ($this->post->id !== $post->id) {
                        $related_post->push($post);
                    }
                }
            }
        }
        return $related_post;
    }
}
