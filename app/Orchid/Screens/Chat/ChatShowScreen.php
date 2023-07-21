<?php

namespace App\Orchid\Screens\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Orchid\Layouts\Chat\ChatShowLayout;
use App\Services\Telegram\ChatService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ChatShowScreen extends Screen
{
    public Chat $chat;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Chat $chat): iterable
    {
        return [
            'chat' => $chat,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return "Просмотр диалога с {$this->chat->first_name} #{$this->chat->id}";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Отметить прочитанными')
                ->method('makeRead'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('chat.messages'),
        ];
    }

    public function makeRead(Chat $chat)
    {
        foreach ($chat->messages()->get() as $message) {
            $message->read = 1;
            $message->save();
        }
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        $data = $request->all();

        Validator::validate($data, [
            'message' => 'required'
        ], [
            'message.*' => 'Сообщение обязательно для заполнения'
        ]);

        $message = new Message();
        $message->chat_id = $chat->id;
        $message->message_id = 0;
        $message->date = Carbon::now()->timestamp;
        $message->text = $data['message'];
        $message->language_code = 'ru-US';
        $message->theme = 'none';
        $message->read = 1;
        $message->type = 'out';
        $message->save();

        $chatService = new ChatService();
        $chatService->sendMessage($chat->id, $data['message'], 'none', false);
    }
}
