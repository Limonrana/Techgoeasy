<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountServices
{
    /**
     * Update the specified account resource in storage.
     *
     * @param  array $data
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(array $data)
    {
        return Auth::user()->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    /**
     * Update the specified old password resource in storage.
     *
     * @param  array $data
     * @return array | boolean
     */
    public function updatePassword(array $data)
    {
        $user = Auth::user();
        if (!Hash::check($data['old_password'], $user->getAuthPassword())) {
            return [
                'message' =>'Current password does not match our records.',
                'code' => 422
            ];
        }
        $update = $user->fill([
            'password' => Hash::make($data['new_password'])
        ])->save();

        return $update ? ['message' => 'Account password was successfully changed!', 'type' => 'success'] :
            ['message' => 'OOPS! There was an error, Please try again.', 'type' => 'error'];
    }
}
