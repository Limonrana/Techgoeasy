<?php

use App\Models\Category;
use App\Models\CustomizeOption;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Collection;

if (!function_exists('customize')) {

    /**
     * Returns customize option details
     *
     * @param string $key
     * @param null $default
     * @return Collection
     * */
    function customize(string $key, $default = null)
    {
        $value = CustomizeOption::getOption($key);
        return isset($value->value) ? collect(json_decode($value->value, true)) : $default;
    }
}

if (!function_exists('getTopCategories')) {

    /**
     * Returns getTopCategories details
     *
     * @param int $limit
     * @param null $default
     * @return Collection
     * */
    function getTopCategories(int $limit, $default = null)
    {
        $value = Category::getTopCategories($limit);
        return isset($value) ? $value : $default;
    }
}

if (!function_exists('getTopTags')) {

    /**
     * Returns getTopCategories details
     *
     * @param int $limit
     * @param null $default
     * @return Collection
     * */
    function getTopTags(int $limit, $default = null)
    {
        $value = Tag::getTopTags($limit);
        return isset($value) ? $value : $default;
    }
}

if (!function_exists('getSetting')) {

    /**
     * Returns setting option details
     *
     * @param string $key
     * @param null $default
     * @return Collection
     * */
    function getSetting(string $key, $default = null)
    {
        $value = Setting::getSetting($key);
        return isset($value->value) ? collect(json_decode($value->value, true)) : $default;
    }
}
