<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
Use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

#[Layout('components.layouts.app')]
#[Title('User Registration Page')]
class Register extends Component
{
    public $username = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $user_nickname = '';
    public function register()
    {
        // Pastikan yang melakukan registrasi adalah manusia
        if($this->user_nickname !== ''){
            return redirect()->route('register');
        }

        // Terapkan rate limiting untuk mencegah brute force
        $this->ensureIsNotRateLimited();

        // Validasi input pengguna
        $this->validate();

        DB::transaction(function () {
            $user = User::create([
                'username' => $this->username,
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            event(new Registered($user));
        });

        session()->flash('success', 'Registrasi berhasil! Silahkan masuk melalui halaman login.');
        return redirect()->intended('/register');
    }

    protected function ensureIsNotRateLimited()
    {
        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');

        $key = 'register|' . sha1($ip . '|' . $userAgent);

        if(RateLimiter::tooManyAttempts($key, 5)){
            $second = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $second,
                    'minutes' => ceil($second / 60),
                ]),
            ]);
        }

        RateLimiter::hit($key);
    }

    protected  function rules()
    {
        return [
            'username' => 'required|string|max:50',
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => ['required', 'confirmed', Password::default()],
        ];
    }

    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
