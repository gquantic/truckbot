<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public int $messageId;
    public int $userId;
    public int $chatId;
    public bool $isBot;
    public string $firstName;
    public string $languageCode;
    public string $type;
    public string $date;
    public string $text;

    public function __construct(array $messageData)
    {
        $this->messageId = $messageData['message']['message_id'];

        $this->userId = $messageData['message']['from']['id'];
        $this->firstName = $messageData['message']['from']['first_name'];
        $this->isBot = $messageData['message']['from']['is_bot'];
        $this->languageCode = $messageData['message']['from']['language_code'];

        $this->chatId = $messageData['message']['chat']['id'];
        $this->type = $messageData['message']['chat']['type'];

        $this->date = $messageData['message']['date'];
        $this->text = $messageData['message']['text'];

        $this->setTheme();
        $this->save();
    }

    public function getOtherMessages(): \Illuminate\Database\Eloquent\Builder
    {
        return Message::query()
            ->where('chat_id', $this->chatId)
            ->orderBy('created_at', 'desc');
    }

    public function save()
    {
        $message = new Message();

        $message->chat_id = $this->chatId;
        $message->user_id = $this->userId;
        $message->first_name = $this->firstName;
        $message->type = $this->type;
        $message->date = $this->date;
        $message->text = $this->text;
        $message->language_code = $this->languageCode;
        $message->is_bot = $this->isBot;

        $message->save();
    }

    public function setTheme(): static
    {
        try {
            $this->theme = $this->getOtherMessages()->first()->theme;
        } catch (\Exception $exception) {}

        return $this;
    }
}
