<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request) : RedirectResponse
    {
        $email = $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            credentials: $email,
        );

        if($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }
        
        return back()->with(['success' => 'reset-link-sent']);
    }
}
