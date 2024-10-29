<?php

namespace App\Http\Controllers;

use App\Events\MessageReceived;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Services\MqttService;
use GuzzleHttp\Psr7\Message;

class WelcomeController extends Controller
{

    public MqttService $mqtt;
    public function __construct(MqttService $mqtt)
    {
        $this->mqtt = $mqtt;
    }
    public function index(Request $request)
    {
        $sales = Sale::all();
        return view('welcome', compact('sales'));
    }

    public function send(Request $request)
    {
        broadcast(new MessageReceived($request->topic, $request->message));

        return redirect()->route('welcome');
    }
}
