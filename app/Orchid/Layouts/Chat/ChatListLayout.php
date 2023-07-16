<?php

namespace App\Orchid\Layouts\Chat;

use App\Models\Chat;
use App\Models\Message;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ChatListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'chats';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', __('№'))
                ->sort()
                ->render(fn (Chat $chat) => $chat->id),

            TD::make('updated_at', __('Имя'))
                ->sort()
                ->render(fn (Chat $chat) => $chat->first_name),

            TD::make('id', __('Всего сообщений'))
                ->sort()
                ->render(function (Chat $chat) {
                    // Непрочитанные
                    $unReads = $chat->messages()->where('read', 0)->count();
                    $label = $unReads > 0 ?
                        " <span style='background: red;color:#fff;padding: 1px 5px;border-radius:4px;'>$unReads</span>" :
                        "";

                    return $chat->messages->count() . $label;
                }),

            TD::make('id', __('Новые сообщения'))
                ->sort()
                ->render(function (Chat $chat) {
                    // Непрочитанные
                    $unReads = $chat->messages()->where('read', 0)->count();

                    return $unReads > 0 ?
                        " <span style='background: red;color:#fff;padding: 1px 5px;border-radius:4px;'>$unReads</span>" :
                        0;
                }),

            TD::make('updated_at', __('Бот'))
                ->sort()
                ->render(fn (Chat $chat) => $chat->is_bot == 1 ? 'Да' : 'Нет'),

            TD::make('updated_at', __('Тип чата'))
                ->sort()
                ->render(fn (Chat $chat) => $chat->type == 'private' ? 'Приватный' : 'Публичный'),

            TD::make('updated_at', __('Создан'))
                ->sort()
                ->render(fn (Chat $chat) => $chat->created_at->toDateTimeString()),

            TD::make('updated_at', __('Создан'))
                ->sort()
                ->render(function (Chat $chat) {
                    return Link::make('Перейти в чат')
                        ->icon('bubbles')
                        ->route('chat.show', $chat->id);
                }),
        ];
    }
}
