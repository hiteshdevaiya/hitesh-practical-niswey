<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layout.guest')]
class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $status = '';

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email');
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
        'password_confirmation' => 'required',
    ];

    public function resetPassword()
    {
        $this->validate(
            $this->rules,
            [
                'password.min' => 'New password must be at least 8 characters.',
                'password.confirmed' => 'New password and confirm password must be same.',
            ],
            [
                'password' => 'new password',
                'password_confirmation' => 'confirm password',
            ]
        );

        $status = Password::broker('admins')->reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password reset successfully.');

            $this->redirectRoute('admin.login', navigate: true);
        } else {
            $this->addError('password', __($status));
        }
    }

    public function render()
    {
        $this->dispatch('initSlick');
        return view('livewire.admin.auth.reset-password');
    }
}
