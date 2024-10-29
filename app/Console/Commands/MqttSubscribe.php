<?php

namespace App\Console\Commands;

use Exception;
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
    private $mqttService;
    public function __construct(MqttService $mqttService)
    {
        parent::__construct();
        $this->mqttService = $mqttService;
    }
    public function handle()
    {
        try {
            $this->mqttService->subscribe('detpos/#', function($topic, $message) {
                $this->info("Received message from {$topic} with {$message}");
            });
        } catch(Exception $e) {
            $this->info("Failed to subscribe : {$e->getMessage()}");
        }
    }
}
