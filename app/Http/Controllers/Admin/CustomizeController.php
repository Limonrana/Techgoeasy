<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CustomizeServices;
use Illuminate\Http\Request;

class CustomizeController extends Controller
{
    /**
     * Display the listing of the resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function index(string $slug)
    {
        $option = customize($slug);
        $isLogo = ($option && $option->has('logo') && $option['logo']) ? true : false;
        return view('admin.pages.appearance.'.$slug, compact('option', 'isLogo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $option
     * @param  CustomizeServices $customizeServices
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $option, CustomizeServices $customizeServices)
    {
        $customizeServices->createOrUpdate($request, $option);
        return back()->with('success', ucfirst($option).' was successfully updated!');
    }
}
