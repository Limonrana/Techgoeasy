<?php

namespace App\Services\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuServices
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $name
     * @return bool
     */
    public function store(string $name) :bool
    {
        $menu = Menu::create(['name' => $name]);
        return !!$menu;
    }
}
