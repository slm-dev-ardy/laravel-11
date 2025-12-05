<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\ForgotPassword;
use App\Livewire\Pages\Auth\ResetPassword;

Route::get('/', Login::class)->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password', ResetPassword::class)->name('password.reset');
});

// Route::get('dashboard', function () {
//     return "Berhasil Login";
// })->middleware('auth')->name('dashboard');
