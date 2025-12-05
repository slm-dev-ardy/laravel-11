<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;

#[Layout('components.layouts.app')]
#[Title('Forgot Password Page')]
class ForgotPassword extends Component
{
    public $email = '';
    public $status = null;

    public function sendResetLink(){
        $this->validate([
            'email' => 'required|email',
        ]);

        $this->ensureIsNotRateLimited();

        $response = Password::sendResetLink(
            ['email' => $this->email]
        );

        RateLimiter::hit($this->throttleKey());

        if($response == Password::RESET_LINK_SENT){
            $this->status = trans($response);
            $this->email = '';
        }else{
            $this->addError('email', trans($response));
        }
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
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

    protected function throttleKey(): string
    {
        // Kunci berdasarkan IP saja (karena email belum tentu valid/terdaftar)
        return 'forgot-password:' . request()->ip();
    }

    public function render()
    {
        return view('livewire.pages.auth.forgot-password');
    }
}
