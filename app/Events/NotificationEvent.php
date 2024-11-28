<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;

class NotificationEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $userId;
    public $title;
    public $content;
    public $senderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $title, $content, $senderId)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->senderId = $senderId;// Automatically sets the current timestamp
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->userId);
    }

    /**
     * Additional data to send with the broadcast.
     * This is the data your frontend will receive.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'sender_id' => $this->senderId,
        ];
    }
}
