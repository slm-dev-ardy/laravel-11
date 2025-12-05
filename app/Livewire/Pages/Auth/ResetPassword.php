<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as PasswordRules;

#[Layout('components.layouts.app')]
#[Title('Reset Password Page')]
class ResetPassword extends Component
{
    public $token;

    #[Validate('required|email')]
    public $email;

    public $password = '';
    public $password_confirmation = '';

    // Menangkap data dari URL saat halaman dibuka
    public function mount($token)
    {
        $this->token = $token;
        // Mengambil email dari query string ?email=...
        $this->email = request()->query('email');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            // Gunakan standar password yang sama dengan Register
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ];
    }

    public function resetPassword()
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        // Proses Reset Password Bawaan Laravel
        // Fungsi ini otomatis mengecek kecocokan Token, Email, dan Expiry date
        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Jika Sukses
        if ($status == Password::PASSWORD_RESET) {
            RateLimiter::clear($this->throttleKey());

            // Flash message sukses ke login page
            session()->flash('success', __($status));

            return redirect()->route('login');
        }

        // Jika Gagal (Token expired atau Email salah)
        RateLimiter::hit($this->throttleKey());
        $this->addError('email', __($status));
    }

    protected function ensureIsNotRateLimited(): void
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
    protected function throttleKey(): string
    {
        return 'reset-password:' . request()->ip();
    }

    public function render()
    {
        return view('livewire.pages.auth.reset-password');
    }
}
