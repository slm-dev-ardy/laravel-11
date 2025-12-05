<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Reset Password Notification')
                ->greeting('Halo!')
                ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
                ->action('Reset Password', url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('Link reset password ini akan kadaluwarsa dalam 60 menit.')
                ->line('Jika Anda tidak meminta reset password, abaikan email ini.')

                // === BAGIAN KUSTOMISASI FOOTER ===
                // Gunakan tanda kutip dua (") agar simbol \n (garis baru) terbaca
                ->line("\n")
                ->salutation(new HtmlString("<b>Terima kasih,</b><br><small>System Administrator<br>PT. Schlemmer Automotive Indonesia</small>"));
        });
    }
}
