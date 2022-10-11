<?php

namespace App\Services\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TagServices
{
    /**
     * Get tags listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Tag[] | LengthAwarePaginator
     */
    public function getTags(Request $request) : LengthAwarePaginator
    {
        $search = $request->get('q');
        if (isset($search) && !empty($search)) {
            return Tag::with(['createdBy', 'updatedBy'])
                ->when($search, function ($query) use ($search) {
                    return $query->where('name', 'like', "%{$search}%");
                })->latest()->paginate('10');
        }  else {
            return Tag::with(['createdBy', 'updatedBy'])
                ->latest()->paginate('10');
        }
    }

    /**
     * Store a newly created tag in database.
     *
     * @param  array $data
     * @return boolean
     */
    public function store(array $data) : bool
    {
        $tag = Tag::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ]);
        return !!$tag;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Tag $tag | null
     */
    public function getTag($id) : ?Tag
    {
        return Tag::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        $tag = Tag::findOrFail($data['id'])
            ->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'description' => $data['description']
            ]);
        return !!$tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id) : bool
    {
        // Find & delete tag
        $tag = Tag::findOrFail($id)->delete();
        return !!$tag;
    }
}
