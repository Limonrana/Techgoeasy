<?php

use App\Models\CustomizeOption;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if (!function_exists('StringToArray')) {

    /**
     * String data convert to array with a separator
     *
     * @param string $string
     * @param string $separator
     * @return \Illuminate\Support\Collection
     */
    function StringToArray(string $string, string $separator) : Collection
    {
        return Str::of($string)->explode($separator);
    }
}

if (!function_exists('IsCollectionValueExist')) {

    /**
     * Check Collection Value is Exist or not
     *
     * @param Collection $collection
     * @param string|int $identifier
     * @return bool
     */
    function IsCollectionValueExist(Collection $collection, $identifier = ', ') : bool
    {
        $findArray = $collection->find($identifier);
        return !!$findArray;
    }
}

if (!function_exists('CollectionToString')) {

    /**
     * Collection data convert to string with a separator
     *
     * @param Collection $all
     * @param string $separator
     * @return string
     */
    function CollectionToString(Collection $all, string $separator = ', ') : string
    {
        return $all->implode(function ($item, $key) {
            return $item->name;
        }, $separator);
    }
}
