<?php

namespace App\Services\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsServices
{
    /**
     * create OR update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $type
     * @return bool
     */
    public function createOrUpdate(Request $request, string $type) : bool
    {
        if ($type === 'general') {
            $all = $request->only('site_title', 'tagline', 'meta_title', 'meta_keywords', 'meta_description');
        }

        $settings = Setting::updateOrCreate(
            ['key' => $type],
            ['value' => json_encode($all)]
        );
        return !!$settings;
    }
}
