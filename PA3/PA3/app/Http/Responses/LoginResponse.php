<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Arahkan berdasarkan role
        if ($user->roles === 'ADMIN') {
            return redirect()->route('admin.dashboard');
        }

        // Default user ke landing page
        return redirect()->route('front.index');
    }
}
