<?php

namespace App\Service\Contacts;

use App\Models\Message;
use App\Notifications\MessageNotification;
use Illuminate\Support\Collection;

class ContactService implements ContactInterface
{
    public function createMessage(Collection $collection): Message
    {
        $message = new Message();

        $message->email = $collection->get('email');
        $message->name = $collection->get('name');
        $message->message = $collection->get('message');
        $message->emailed = false;
        $message->save();

        $message->notify(new MessageNotification());

        return $message;
    }
}
