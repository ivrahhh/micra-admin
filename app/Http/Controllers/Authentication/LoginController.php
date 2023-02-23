<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Handle the admin authentication.
     */
    public function __invoke(LoginRequest $request) : RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended();
    }
}
