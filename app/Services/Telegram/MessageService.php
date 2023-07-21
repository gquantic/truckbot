<?php

namespace App\Services\Telegram;

use App\Models\User;
use Illuminate\Support\Str;

class MessageService
{
    protected ChatService $chatService;

    public function __construct()
    {
        $this->chatService = new ChatService();
    }

    /**
     * Запускаем обработку сообщения
     *
     * @return void
     */
    public function handle($chatId, $message, $theme = 'none')
    {
        $message = str_replace(['/'], '', strtolower($message));

        if (Str::contains($message, config('messages.link-truck'))) {
            $this->chatService->sendMessage($chatId, 'Пожалуйста, отправьте токен для привязки из личного кабинета.');
        }

        if (Str::contains($message, config('messages.call-truck'))) {
            $this->chatService->sendMessage($chatId, 'Заявка отправлена оператору, пожалуйста, ожидайте обратной связи.');
        }
    }
}
