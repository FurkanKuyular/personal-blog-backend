<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You have a message from personal blog')
            ->greeting(sprintf('Hello Boss you have a message from: %s', $notifiable->email))
            ->line($notifiable->message)
            ->salutation($notifiable->name);
    }
}
