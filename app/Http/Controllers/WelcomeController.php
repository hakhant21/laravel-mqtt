<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Concerns\HasMessage;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Services\MqttService;
use App\Events\MessageReceived;

class WelcomeController extends Controller
{
    use HasMessage;

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

        $this->handleMessage($request->topic, $request->message);

        return redirect()->route('welcome');
    }
}
