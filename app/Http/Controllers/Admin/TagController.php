<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagStoreRequest;
use App\Http\Requests\Admin\TagUpdateRequest;
use App\Services\Admin\TagServices;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @var $tagServices
     */
    protected TagServices $tagServices;

    /**
     * Create a new Tag Controller instance.
     *
     * @param TagServices $tagServices
     * @return void
     */
    public function __construct(TagServices $tagServices)
    {
        $this->tagServices = $tagServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $tags = $this->tagServices->getTags($request);
        $q = $request->get('q', '');
        return view('admin.pages.tags', compact('tags', 'q'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagStoreRequest $request)
    {
        // Retrieve the validated input data and store via tag services
        $tag = $this->tagServices->store($request->validated());
        if (!$tag) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Tag was created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return response()->json($this->tagServices->getTag($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagUpdateRequest $request)
    {
        // Retrieve the validated input data and store via tag services
        $tag = $this->tagServices->update($request->validated());
        if (!$tag) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Tag was created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Destroy tag via services
        $category = $this->tagServices->destroy($id);
        if (!$category) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Tag was deleted successfully!');
    }
}
