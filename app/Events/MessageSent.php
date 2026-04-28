<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message->load('sender');
    }

    public function broadcastOn()
    {
        $ids = [$this->message->sender_id, $this->message->receiver_id];
        sort($ids);
        return new PrivateChannel('chat.' . $ids[0] . '.' . $ids[1]);
    }

    public function broadcastWith()
    {
        return [
            'id'         => $this->message->id,
            'body'       => $this->message->body,
            'sender_id'  => $this->message->sender_id,
            'sender'     => [
                'id'     => $this->message->sender->id,
                'name'   => $this->message->sender->name,
                'avatar' => asset($this->message->sender->getAvatar()),
            ],
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }
}
