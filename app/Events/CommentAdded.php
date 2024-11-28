<?php  
namespace App\Events;  

use Illuminate\Broadcasting\PrivateChannel; 
use Illuminate\Broadcasting\InteractsWithSockets; 
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; 
use Illuminate\Foundation\Events\Dispatchable; 
use Illuminate\Queue\SerializesModels;  
use App\Models\Comment;

class CommentAdded implements ShouldBroadcast {     
    use Dispatchable, InteractsWithSockets, SerializesModels;      

    /**      
     * The comment instance.      
    */     


    public Comment $comment;

    /**      
     * Create a new event instance.      
     *      
     * @param Comment $comment      
     */     
    public function __construct(Comment $comment)     
    {         
        $this->comment = $comment;     
    }      

    /**      
     * Get the channels the event should broadcast on.      
     *      
     * @return PrivateChannel     
     */          
    public function broadcastOn(): PrivateChannel     
    {         
        return new PrivateChannel('comments'); // Private channel for the ticket
    }

    /** 
     * Customize the broadcasted data.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->comment->id,
            'ticket_id' => $this->comment->ticket_id,
            'user_id' => $this->comment->user_id,
            'user_name' => $this->comment->user_name,
            'user_role' => $this->comment->user_role,
            'content' => $this->comment->content,
            'created_at' => $this->comment->created_at->toDateTimeString(),
        ];
    }
}
