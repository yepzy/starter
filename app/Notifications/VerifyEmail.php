<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail implements ShouldQueue
{
    use Queueable;
    public $tries = 3;

    /**
     * Create a notification instance.
     */
    public function __construct()
    {
        $this->queue = 'high';
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(__('mail.emailVerification.subject'))
            ->greeting(__('mail.notification.greeting.named', ['name' => $notifiable->name]))
            ->line(__('mail.emailVerification.message'))
            ->action(__('mail.emailVerification.action'), $this->verificationUrl($notifiable))
            ->line(__('mail.emailVerification.notice'));
    }
}
