<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('User Authentication | Login Page')]
class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login(){
        $this->validate([
            'email' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        $this->addError('username', 'Kombinasi username dan password salah');
    }
    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
