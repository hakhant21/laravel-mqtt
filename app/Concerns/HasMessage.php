<?php

namespace App\Concerns;

use App\Models\Sale;
use Illuminate\Support\Str;

trait HasMessage
{
    public function handleMessage(array $topic, array $message)
    {
        switch($topic[2]) {
            case 'preset':
                $this->handlePresetMessage($topic, $message);
                break;
            case 'permit':
                $this->handlePermitMessage($topic, $message);
                break;
            case 'Final':
                $this->handleFinalMessage($topic, $message);
                break;
            default:
                break;
        }
    }

    public function handlePresetMessage(array $topic, array $message)
    {
        $sale = Sale::create([
            'dep_no' => $topic[0],
            'nozzle_no' => $message[0],
            'preset' => ltrim($message[1], '0')
        ]);
    }

    public function handlePermitMessage(array $topic, array $message)
    {
        //
    }

    public function handleFinalMessage(array $topic, array $message)
    {
        //
    }
}
