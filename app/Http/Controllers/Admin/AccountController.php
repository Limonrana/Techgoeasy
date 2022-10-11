<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountUpdateRequest;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Services\Admin\AccountServices;

class AccountController extends Controller
{
    /**
     * Display a listing of the account resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function account()
    {
        return view('admin.pages.account');
    }

    /**
     * Display a listing of the change password resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        return view('admin.pages.change-password');
    }

    /**
     * Update the specified account resource in storage.
     *
     * @param  AccountUpdateRequest $request
     * @param  AccountServices $accountServices
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(AccountUpdateRequest $request, AccountServices $accountServices)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $update = $accountServices->updateAccount($validated);
        return $update ?
            back()->with('success', 'Account was successfully updated!') :
            back()->with('error', 'OOPS! There was an error');
    }

    /**
     * Update the specified old password resource in storage.
     *
     * @param  PasswordUpdateRequest $request
     * @param  AccountServices $accountServices
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordUpdateRequest $request, AccountServices $accountServices)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $update = $accountServices->updatePassword($validated);
        // Check error exist or not
        if (array_key_exists('code', $update) && $update['code'] === 422) {
            return back()->withErrors([
                'old_password' => [$update['message']]
            ]);
        }
        return back()->with($update['type'], $update['message']);
    }
}
