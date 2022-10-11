<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryServices
{
    /**
     * Get a categories listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Category[] | LengthAwarePaginator
     */
    public function getCategories(Request $request) : LengthAwarePaginator
    {
        $search = $request->get('q');
        if (isset($search) && !empty($search)) {
            return Category::with(['createdBy', 'updatedBy'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })->latest()->paginate('10');
        }  else {
            return Category::with(['createdBy', 'updatedBy'])
                ->latest()->paginate('10');
        }
    }

    /**
     * Store a newly created category in database.
     *
     * @param  array $data
     * @return boolean
     */
    public function store(array $data) : bool
    {
        $category = Category::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ]);
        return !!$category;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Category $category | null
     */
    public function getCategory($id) : ?Category
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        $category = Category::findOrFail($data['id'])
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'description' => $data['description']
            ]);
        return !!$category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id) : bool
    {
        // Destroy category via services
        $category = Category::findOrFail($id)->delete();
        return !!$category;
    }
}
