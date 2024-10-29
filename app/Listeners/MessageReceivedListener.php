<?php

namespace App\Listeners;

use App\Concerns\HasMessage;
use App\Events\MessageReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageReceivedListener
{
    use HasMessage;

    public function handle(MessageReceived $event)
    {
        $this->handleMessage($event->topic, $event->message);
    }
}
