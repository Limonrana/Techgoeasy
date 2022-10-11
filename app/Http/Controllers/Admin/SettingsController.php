<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SettingsServices;
use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $type
     * @return \Illuminate\Contracts\View\View
     */
    public function index(string $type)
    {
        $option = getSetting('general');
        return view('admin.pages.settings.'.$type, compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $type
     * @param  SettingsServices $settingsServices
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $type, SettingsServices $settingsServices)
    {
        $settingsServices->createOrUpdate($request, $type);
        return back()->with('success', ucfirst($type).' settings was successfully updated!');
    }

    /**
     * Sitemap generate for whole of the resources.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sitemap()
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
        return back()->with('success', 'Sitemap was updated successfully!');
    }
}
