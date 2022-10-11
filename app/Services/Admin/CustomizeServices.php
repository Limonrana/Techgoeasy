<?php

namespace App\Services\Admin;

use App\Models\CustomizeOption;
use Illuminate\Http\Request;

class CustomizeServices
{

    /**
     * createOrUpdate the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $option
     * @return bool
     */
    public function createOrUpdate(Request $request, string $option) : bool
    {
        if ($option === 'header') {
            $all = $request->only('logo', 'alt_text', 'logo_width', 'logo_height', 'facebook', 'twitter', 'linkedin', 'instagram');
        }
        else if ($option === 'footer') {
            $all = $request->only('logo', 'alt_text', 'logo_width', 'logo_height', 'about_company', 'copy_right_text');
        }
        else if ($option === 'home') {
            $all = $request->only('banner_script_1', 'banner_script_2', 'banner_script_3', 'sidebar_script_1', 'sidebar_script_2', 'sidebar_script_3', 'sidebar_script_4');
        }
        else if ($option === 'post') {
            $all = $request->only('banner_script_1', 'banner_script_2', 'banner_script_3', 'sidebar_script_1', 'sidebar_script_2', 'sidebar_script_3');
        }
        else if ($option === 'taxonomy') {
            $all = $request->only('banner_script_1', 'banner_script_2', 'sidebar_script_1', 'sidebar_script_2', 'sidebar_script_3');
        }
        else if ($option === 'hcaptcha') {
            $all = $request->only('banner_script_1', 'banner_script_2');
        }
        else if ($option === 'continue') {
            $all = $request->only('banner_script_1', 'banner_script_2');
        }
        else if ($option === 'clickable') {
            $all = $request->only('click_url_1', 'click_url_2', 'click_url_3', 'click_url_4', 'click_url_5');
        }

        $customize = CustomizeOption::updateOrCreate(
            ['key' => $option],
            ['value' => json_encode($all)]
        );
        return !!$customize;
    }

}
