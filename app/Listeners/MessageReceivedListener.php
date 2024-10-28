<?php

namespace App\Listeners;

use App\Concerns\HasMessage;
use App\Events\MessageReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageReceivedListener 
{
    use HasMessage;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageReceived $event)
    {
        $topic = explode('/', $event->topic);
        $message = preg_split('/[A-Z]/', $event->message);

        $this->handleMessage($topic, $message);
    }
}
