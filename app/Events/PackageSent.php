<?php  
namespace App\Events;  

use Illuminate\Broadcasting\PrivateChannel; // Changed from Channel
use Illuminate\Broadcasting\InteractsWithSockets; 
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; 
use Illuminate\Foundation\Events\Dispatchable; 
use Illuminate\Queue\SerializesModels;  

class PackageSent implements ShouldBroadcast {     
    use Dispatchable, InteractsWithSockets, SerializesModels;      

    /**      
     * The count of packages.      
     */     
    public int $count;
    public string $s;

    /**      
     * Create a new event instance.      
     *      
     * @param int $count      
     */     
    public function __construct(string $s, int $count)     {         
        $this->s = $s;         
        $this->count = $count;     
    }      

    /**      
     * Get the channels the event should broadcast on.      
     *      
     * @return PrivateChannel     
     */          
    public function broadcastOn(): PrivateChannel     {         
        return new PrivateChannel('delivery'); // Added dynamic channel suffix
    } 
}