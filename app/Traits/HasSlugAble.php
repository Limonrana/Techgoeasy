<?php

namespace App\Traits;

trait HasSlugAble
{

    /**
     * Boot the SlugAble and its traits.
     *
     * @return void
     */
    public static function bootSlugAble() : void
    {
        static::saving(function ($model) {
            $settings = $model->sluggable();
            $model->slug = $model->generateSlug($settings['source']);
        });
    }

    /**
     * sluggable source array from model
     *
     * @return array
     */
    abstract public function slugAble(): array;


    /**
     * Generated the slug url from traits.
     *
     * @return $string
     */
    public function generateSlug($string) : string
    {
        return strtolower(preg_replace(
            ['/[^\w\s]+/', '/\s+/'],
            ['', '-'],
            $string
        ));
    }
}
