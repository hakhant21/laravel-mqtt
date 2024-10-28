<?php

namespace App\Console\Commands;

use App\Services\MqttService;
use App\Events\MessageReceived;
use Illuminate\Console\Command;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mqtt Subscribe Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = new MqttService();

        $mqtt->subscribe('detpos/#', function ($topic, $message) {
            broadcast(new MessageReceived($topic, $message));
        });

        $this->info('Listening for messages...');

        while (true) {
            $mqtt->loop();
        }

    }
}
