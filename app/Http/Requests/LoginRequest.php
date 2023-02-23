<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * Attempt to authenticate the user.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate() : void
    {
        $this->checkRateLimit();

        if(!$this->attempt()) {
            RateLimiter::clear($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => trans('auth.password'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Check if the user can be authenticated.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function attempt() : bool
    {
        $user = User::query()->where('email', $this->input('email'))->first(['id','email']);

        if(is_null($user)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        return Auth::guard('admin')->attempt(
            credentials: $this->validated(),
            remember: $this->boolean('remember'),
        );
    }

    /**
     * Check if the request is rate limited.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    private function checkRateLimit() : void
    {
        if(RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            event(new Lockout($this));

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey()),
                ])
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key.
     */
    private function throttleKey() : string
    {
        return Str::transliterate($this->ip().':'.Str::lower($this->input('email')));
    }
}
