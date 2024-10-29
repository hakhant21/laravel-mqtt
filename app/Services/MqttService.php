<?php

namespace App\Services;

use Exception;
use PhpMqtt\Client\MqttClient;
use App\Events\MessageReceived;
use Laravel\Reverb\Protocols\Pusher\EventDispatcher;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
     private MqttClient $mqtt;
     private ConnectionSettings $settings;
     public function __construct()
     {
          $this->mqtt = new MqttClient(config('mqtt.host'), config('mqtt.port'), config('mqtt.client_id'));

          $this->settings = (new ConnectionSettings())
                            ->setUsername(config('mqtt.username'))
                            ->setPassword(config('mqtt.password'))
                            ->setKeepAliveInterval(config('mqtt.keep_alive'));
     }

     public function connect()
     {
         try {
            $this->mqtt->connect($this->settings, config('mqtt.clean_session'));

            echo 'Connected to ' . config('mqtt.host') . ':' . config('mqtt.port') . ' as ' . config('mqtt.client_id') . "\n";
         } catch (Exception $e) {
            echo "Connect failed: " . $e->getMessage() . "\n";
         }
     }

     public function publish($topic, $message)
     {
        $this->connect();

         try {
            $this->mqtt->publish($topic, $message, 0, false);

            echo "Message published to: " . $topic . " with " . $message . "\n";

            $this->disconnect();

         } catch (Exception $e) {
            echo "Publish failed: " . $e->getMessage() . "\n";

            if ($this->connect()) {
                $this->publish($topic, $message);
            }
         }
     }

     public function subscribe($topic, callable $callback)
     {
        $this->connect();

        try {
            $this->mqtt->subscribe($topic, function($topic, $message) use($callback) {
                broadcast(new MessageReceived($topic, $message));

                call_user_func($callback, $topic, $message);

            }, 0);

            $this->loop();

            $this->disconnect();
        } catch (Exception $e) {
            echo "Subscribe failed: " . $e->getMessage() . "\n";

            if($this->connect()) {
                $this->subscribe($topic, $callback);
            }
        }
     }

     public function loop()
     {
         while($this->mqtt->isConnected()) {
             $this->mqtt->loop(true);
         }
     }

     public function disconnect()
     {
         $this->mqtt->disconnect();
     }
}
