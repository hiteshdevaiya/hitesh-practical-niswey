<?php

namespace App\Livewire\Admin\Auth;

use App\Rules\StrictEmail;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layout.guest')]
class ForgotPassword extends Component
{
    public $email = '';
    public $status = '';
    public $isThrottled = false;
    public $throttleSeconds;

    public function mount()
    {
        $this->throttleSeconds = config('auth.passwords.admins.throttle', 60);
    }

    protected function rules()
    {
        return [
            'email' => ['required', 'email', new StrictEmail, 'max:255']
        ];
    }

    public function sendResetLink(bool $fromModal = false)
    {
        $this->validate();

        $status = Password::broker('admins')->sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = __($status);
            $this->resetErrorBag();
            $this->isThrottled = false;
            if (!$fromModal) {
                $this->dispatch('show-success-modal');
            }
        } else {
            if ($status === 'passwords.throttled') {
                $this->isThrottled = true;
                $this->reset('status');
                $this->resetErrorBag();
                $this->dispatch('handle-throttle');
                return;
            } else {
                $this->isThrottled = false;
                $this->addError($fromModal ? 'modal' : 'email', __($status));
            }
        }
    }

    public function clearThrottle()
    {
        $this->isThrottled = false;
    }

    public function clearValidationMessages()
    {
        $this->reset('email', 'status');
        $this->clearThrottle();
        $this->resetValidation();
    }

    public function render()
    {
        $this->dispatch('initSlick');
        return view('livewire.admin.auth.forgot-password');
    }
}
