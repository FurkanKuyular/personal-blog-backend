<?php

namespace App\Listeners;

use App\Models\Message;
use Illuminate\Notifications\Events\NotificationSent;

class MessageNotificationSentListener
{
    public function handle(NotificationSent $event): void
    {
        if ($event->notifiable instanceof Message) {
            $event->notifiable->emailed = true;
            $event->notifiable->save();
        }
    }
}
