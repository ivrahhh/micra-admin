<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ResetPasswordRequest;
use App\Models\Admin;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ResetPasswordController extends Controller
{
    public function create(Request $request) : Response
    {
        return Inertia::render('Authentication/ResetPassword', [
            'email' => $request->query('email'),
            'token' => $request->token,
        ]);
    }

    public function store(ResetPasswordRequest $request) : RedirectResponse
    {
        $status = Password::reset(
            credentials: $request->validated(),
            callback: function (Admin $admin, string $password) {
                $admin->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ]);

                $admin->save();

                event(new PasswordReset($admin));
            }
        );

        if($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }

        return to_route('login')->with(['success' => 'password-reset']);
    }
}
