<?php


return [
    'host' => env('MQTT_HOST', '127.0.0.1'),
    'port' => env('MQTT_PORT', 1883),
    'client_id' => env('MQTT_CLIENT_ID', "detpos-".uniqid()),
    'username' => env('MQTT_USERNAME', 'detpos'),
    'password' => env('MQTT_PASSWORD', 'asdffdsa'),
    'clean_session' => env('MQTT_CLEAN_SESSION', true),
    'keep_alive' => env('MQTT_KEEPALIVE', 60),
];
