<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (Auth::user()->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->usertype === 'jamaah') {
            return redirect()->route('jamaah.dashboard');
        }

        return redirect('/');
    }
}
