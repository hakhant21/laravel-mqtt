<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Events\MessageReceived;
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
        $sales = Sale::orderBy('created_at', 'desc')->paginate(12);

        return view('welcome', compact('sales'));
    }

    public function send(Request $request)
    {
        $this->mqtt->publish($request->topic, $request->message);

        broadcast(new MessageReceived($request->topic, $request->message));

        return redirect()->route('welcome');
    }
}
