<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
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
            'old_password' => ['required', 'max:16'],
            'new_password' => ['required', 'confirmed', 'max: 16', Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
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
            'old_password.required'     => 'Current password is required!',
            'new_password.required'     => 'New password is required!',
            'new_password.confirmed'    => 'Confirm password is not match!',
            'new_password.max'          => 'New password must be less then 16 characters!',
        ];
    }
}
