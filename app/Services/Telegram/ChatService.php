<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

class ChatService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('telegram.api.key');
    }

    public function sendMessage(int $chatId, string $text)
    {
        Http::post("https://api.telegram.org/bot{$this->apiKey}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }
}
