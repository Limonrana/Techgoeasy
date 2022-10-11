<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Admin\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var $categoryServices
     */
    protected CategoryServices $categoryServices;

    /**
     * Create a new Category Controller instance.
     *
     * @param CategoryServices $categoryServices
     * @return void
     */
    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->categoryServices->getCategories($request);
        $q = $request->get('q', '');
        return view('admin.pages.categories', compact('categories', 'q'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        // Retrieve the validated input data and store via category services
        $category = $this->categoryServices->store($request->validated());
        if (!$category) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Category was created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return response()->json($this->categoryServices->getCategory($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request)
    {
        // Retrieve the validated input data and store via category services
        $category = $this->categoryServices->update($request->validated());
        if (!$category) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Category was created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Destroy category via services
        $category = $this->categoryServices->destroy($id);
        if (!$category) return back()->with('error', 'OOPS! There was an server side error.');
        return back()->with('success', 'Category was deleted successfully!');
    }
}
