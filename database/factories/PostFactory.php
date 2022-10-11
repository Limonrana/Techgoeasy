<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imgArr = ['6336c84e36423.jpeg', '633859c3c8902.jpg', '633859c38e6aa.jpg', '633859c38e6cb.jpg', '633859c38e7b6.jpg'];
        $title = fake()->text(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(50),
            'featured_image' => asset('storage/photos/shares/'.Arr::random($imgArr)),
            'alt_text' => $title,
            'meta_title' => $title,
            'meta_description' => 'This is test meta description',
            'meta_keywords' => 'Post, MyBlog, SEO, Development',
            'status' => '1',
            'visibility' => '1',
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
