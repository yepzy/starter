<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCredentialsReset extends Notification implements ShouldQueue
{
    use Queueable;
    public $tries = 3;
    protected $pageUrl;
    protected $data;

    /**
     * Create a notification instance.
     *
     * @param array $data
     * @param string $password
     */
    public function __construct(array $data, string $password)
    {
        $this->queue = 'high';
        $this->data = array_merge($data, ['password' => $password]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        $mailMessage = (new MailMessage)
            ->subject(__('mail.UserCredentialsReset.subject'))
            ->greeting(__('mail.notification.greeting.named', ['name' => $this->data['first_name']]))
            ->line(__('mail.UserCredentialsReset.introduction'))
            ->line('  ')
            ->line(__('mail.UserCredentialsReset.registration', ['url' => route('home')]));
        foreach (__('mail.UserCredentialsReset.possibilities') as $possibility) {
            $mailMessage->line($possibility);
        }
        $mailMessage->line('  ')
            ->line(__('mail.UserCredentialsReset.connection'))
            ->line(__('mail.UserCredentialsReset.credentials.email', [
                'email' => $this->data['email'],
            ]))
            ->line(__(
                'mail.UserCredentialsReset.credentials.password',
                ['password' => $this->data['password']]
            ))
            ->line('  ')
            ->action(__('mail.UserCredentialsReset.action'), route('user.profile.edit'))
            ->line('  ')
            ->line(__('mail.UserCredentialsReset.closing'));

        return $mailMessage;
    }
}
