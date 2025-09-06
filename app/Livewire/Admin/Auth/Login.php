<?php

namespace App\Livewire\Admin\Auth;

use App\Rules\StrictEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layout.guest')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected function rules()
    {
        return [
            'email' => ['required', 'email', new StrictEmail, 'max:255'],
            'password' => 'required|string|min:8',
        ];
    }

    protected function messages()
    {
        return [
            'password.min' => 'Password must be at least 8 characters.',
        ];
    }

    public function login()
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (Auth::guard('admin')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            RateLimiter::clear($this->throttleKey());
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Increment failed attempts
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    protected function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey()
    {
        return 'login|' . request()->ip();
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
