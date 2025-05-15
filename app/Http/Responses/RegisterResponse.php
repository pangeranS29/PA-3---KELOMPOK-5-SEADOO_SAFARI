<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Arahkan berdasarkan role setelah register
        if ($user->roles === 'ADMIN') {
            return redirect()->route('admin.dashboard');
        }

        // Default USER ke front.index
        return redirect()->route('front.index');
    }
}
