<?php

namespace App\Service\Contacts;

use App\Models\Message;
use Illuminate\Support\Collection;

interface ContactInterface
{
    public function createMessage(Collection $collection): Message;
}
