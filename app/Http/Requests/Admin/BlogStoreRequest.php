<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max: 100'],
            'slug' => ['required', 'max: 100', Rule::unique('posts')],
            'meta_description' => ['max: 160'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'    => 'Post title is missing, please put the title then slug will be appear auto!',
            'title.max'         => 'OOPS! Post title should be not be more then 100 characters.',
            'slug.required'     => 'Permalink slug is missing, please put the title then slug will be appear auto!',
            'slug.unique'       => 'OOPS! Permalink slug should be unique, please rewrite the slug.',
            'slug.max'          => 'OOPS! Permalink slug should not be more then 100 characters.',
            'meta_description.max' => 'OOPS! Permalink meta description can not be more then 160 characters.',
        ];
    }
}
