<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{
    /**
     * Display a listing of the dashboard page resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $category = Category::count();
        $tag = Tag::count();
        $blog = Post::count();
        $recentPosts = Post::latest('id')->take(5)->get();
        return view('admin.pages.dashboard', compact('category', 'tag', 'blog', 'recentPosts'));
    }

    /**
     * Display a listing of the media page resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function media()
    {
        return view('admin.pages.media');
    }
}
