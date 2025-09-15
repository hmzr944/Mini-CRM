<?php

namespace App\Providers;

use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
   public function boot(): void
{
    if (app()->runningInConsole()) {
        return; // Évite pendant les migrations
    }

    if (Schema::hasTable('mail_settings')) {
        $mail = \App\Models\MailSetting::first();
        if ($mail) {
            Config::set('mail.mailers.smtp.transport', $mail->mail_mailer);
            Config::set('mail.mailers.smtp.host', $mail->mail_host);
            Config::set('mail.mailers.smtp.port', $mail->mail_port);
            Config::set('mail.mailers.smtp.username', $mail->mail_username);
            Config::set('mail.mailers.smtp.password', $mail->mail_password);
            Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);
            Config::set('mail.from.address', $mail->mail_from_address);
            Config::set('mail.from.name', $mail->mail_from_name);
        }
    }
}

}
