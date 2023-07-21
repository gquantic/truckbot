<?php

namespace App\Services\Telegram;

use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ChatService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('telegram.api.key');
    }

    public function sendMessage(int $chatId, string $text, $theme = 'none', $save = true)
    {
        Http::post("https://api.telegram.org/bot{$this->apiKey}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        if ($save)
            $this->saveResponse($chatId, $text);
    }

    public function saveResponse($chatId, $text)
    {
        $message = new Message();

        $message->chat_id = $chatId;
        $message->message_id = 0;
        $message->date = Carbon::now()->timestamp;
        $message->text = $text;
        $message->language_code = 'ru-US';

        $message->save();
    }
}
