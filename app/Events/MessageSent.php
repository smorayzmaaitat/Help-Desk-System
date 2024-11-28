<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param  array  $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    /**
     * Data sent with the broadcast event.
     */
    public function broadcastWith()
    {
        return [
            'message_id' => $this->message['message_id'],
            'sender_id' => $this->message['sender_id'],
            'receiver_id' => $this->message['receiver_id'],
            'content' => $this->message['content'],
            'image' => $this->message['image'],
            'created_at' => $this->message['created_at'],
        ];
    }
}

