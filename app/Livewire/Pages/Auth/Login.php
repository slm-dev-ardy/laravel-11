<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

#[Layout('components.layouts.app')]
#[Title('User Authentication | Login Page')]
class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    public function login(){
        $this->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited();

        if(!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)){
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
                'password' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        session()->regenerate();
        session()->flash('success', 'You are logged in successfully!');
        return redirect()->intended('/dashboard');
    }

    protected function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username)).'|'.request()->ip();
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
