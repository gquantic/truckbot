<?php

namespace App\Http\Controllers\Linguist;

use App\Events\IncomingMessage;
use App\Http\Controllers\Controller;
use App\Services\Telegram\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TypeController extends Controller
{
    public function handle(Request $request)
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        var_dump($data);
        exit();

        if ($data['message']['message_id'] == 0)
            return Response::json(['status' => 'ok', 'message' => 'Repeat self message'], 200);

        return event(new IncomingMessage($data));
    }

    public function sendMessage($chatId, $message)
    {
        $service = new ChatService();
        $service->sendMessage($chatId, $message);
    }
}
