<?php

namespace App\Orchid\Layouts\Chat;

use App\Models\Chat;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;

class ChatShowLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            TextArea::make('message')
                ->title('Текст сообщения')
                ->rows(4),

            Button::make('Отправить')
                ->method('sendMessage'),
        ];
    }
}
