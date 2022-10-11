<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\Admin\BlogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BlogController extends Controller
{
    /**
     * @var $blogServices
     */
    protected BlogServices $blogServices;

    /**
     * Create a new Blog Controller instance.
     *
     * @param BlogServices $blogServices
     * @return void
     */
    public function __construct(BlogServices $blogServices)
    {
        $this->blogServices = $blogServices;
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $blogs = $this->blogServices->getBlogs($request);
        $q = $request->get('q', '');
        return view('admin.pages.blogs', compact('blogs', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        $app_url = Config::get('app.url');
        return view('admin.pages.create-blog', compact('categories', 'tags', 'app_url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogStoreRequest $request)
    {
        $blog = $this->blogServices->store($request->all());
        if (!$blog) return back()->with('error', 'OOPS! There was an server side error.');
        return redirect()->route('admin.blogs.edit', $blog->id)->with('success', 'Post was created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $blog = $this->blogServices->getPost($id);
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        $app_url = Config::get('app.url');
        $click_urls = $blog->click_url ? json_decode($blog->click_url) : null;
        return view('admin.pages.edit-blog', compact('blog', 'categories', 'tags', 'app_url', 'click_urls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogUpdateRequest $request
     * @param  Post $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogUpdateRequest $request, Post $blog)
    {
        // Retrieve the validated input data and store via category services
        $blog = $this->blogServices->update($request->all(), $blog);
        if (!$blog) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Post was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Delete blog post via services
        $blog = $this->blogServices->destroy($id);
        if (!$blog) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Post was deleted successfully!');
    }
}
