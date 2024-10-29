<?php

namespace App\Services;

use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;

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

          $this->mqtt->connect($this->settings, config('mqtt.clean_session'));
     }

     public function publish($topic, $message)
     {
          if($this->isConnected()) {
                $this->mqtt->publish($topic, $message);
          }
     }

     public function subscribe($topic, $callback)
     {
          if($this->isConnected()) {
               $this->mqtt->subscribe($topic, function($topic, $message) use ($callback) {
                    $callback($topic, $message);
               }, MqttClient::QOS_AT_MOST_ONCE);
          }
     }

     public function disconnect()
     {
          $this->mqtt->disconnect();
     }

     public function isConnected()
     {
          return $this->mqtt->isConnected();
     }

     public function loop()
     {
          $this->mqtt->loop(true);
     }
}
