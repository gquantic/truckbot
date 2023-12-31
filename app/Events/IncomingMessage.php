<?php

namespace App\Events;

use App\Repositories\MessageRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Response;

class IncomingMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public MessageRepository $message;

    /**
     * Create a new event instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __construct(array $messageData)
    {
        $this->message = new MessageRepository($messageData);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
