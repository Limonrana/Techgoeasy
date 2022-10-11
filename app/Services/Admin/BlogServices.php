<?php

namespace App\Services\Admin;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class BlogServices
{
    /**
     * Get the blog post listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Post[] | LengthAwarePaginator
     */
    public function getBlogs(Request $request) : LengthAwarePaginator
    {
        $search = $request->get('q');
        if (isset($search) && !empty($search)) {
            return Post::with(['categories', 'tags', 'createdBy', 'updatedBy'])
                ->when($search, function ($query) use ($search) {
                    return $query->where('title', 'like', "%{$search}%");
                })->latest('id')->paginate('10');
        }  else {
            return Post::with(['categories', 'tags', 'createdBy', 'updatedBy'])
                ->latest('id')->paginate('10');
        }
    }

    /**
     * Store a newly created blog post in database.
     *
     * @param  array $all
     * @return Post
     */
    public function store(array $all) : Post
    {
        $is_featured = false;
        if (array_key_exists('is_featured', $all)) {
            if ($all['is_featured'] === 'on') {
                $is_featured = true;
            }
        }
        $post = new Post();
        $post->title              =  $all['title'];
        $post->slug               =  $all['slug'];
        $post->description        =  $all['description'];
        $post->featured_image     =  $all['featured_image'];
        $post->alt_text           =  $all['alt_text'];
        $post->meta_title         =  $all['meta_title'];
        $post->meta_description   =  $all['meta_description'];
        $post->meta_keywords      =  array_key_exists('meta_keywords', $all) ?
                                        join(', ', $all['meta_keywords']) : null;
        $post->status             =  $all['status'];
        $post->visibility         =  $all['visibility'];
        $post->is_featured        =  $is_featured;
        $post->save();

        // sync all category and tags
        if (array_key_exists('categories', $all)) {
            $post->categories()->sync($all['categories']);
        } else {
            $post->categories()->sync([1]);
        }
        if (array_key_exists('tags', $all)) {
            $post->tags()->sync($all['tags']);
        }

        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder[] $post | null
     */
    public function getPost(int $id) : Model
    {
        return Post::with(['categories', 'tags'])->find($id);
    }

    /**
     * Update the blog post in database.
     *
     * @param  array $all
     * @param  Post  $post
     * @return Post
     */
    public function update(array $all, Post $post) : Post
    {
        $is_featured = false;
        if (array_key_exists('is_featured', $all)) {
            if ($all['is_featured'] === 'on') {
                $is_featured = true;
            }
        }
        $post->title              =  $all['title'];
        $post->slug               =  $all['slug'];
        $post->description        =  $all['description'];
        $post->featured_image     =  $all['featured_image'];
        $post->alt_text           =  $all['alt_text'];
        $post->meta_title         =  $all['meta_title'];
        $post->meta_description   =  $all['meta_description'];
        $post->meta_keywords      =  array_key_exists('meta_keywords', $all) ?
                                        join(', ', $all['meta_keywords']) : null;
        $post->status             =  $all['status'];
        $post->visibility         =  $all['visibility'];
        $post->is_featured        =  $is_featured;
        $post->save();

        // sync all category and tags
        if (array_key_exists('categories', $all)) {
            $post->categories()->sync($all['categories']);
        } else {
            $post->categories()->sync([1]);
        }
        if (array_key_exists('tags', $all)) {
            $post->tags()->sync($all['tags']);
        }
        return $post;
    }

    /**
     * Remove the blog post resource from database.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(int $id) : bool
    {
        // Destroy category via services
        $blog = Post::findOrFail($id);
        $blog->categories()->detach();
        $blog->tags()->detach();
        $blog->delete();
        return !!$blog;
    }
}
