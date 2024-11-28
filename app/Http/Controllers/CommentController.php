<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Events\CommentAdded;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;
use Inertia\Inertia;
use App\Events\NotificationEvent;



class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
        $Ticket = Ticket::findOrFail( $request->ticket_id);


        // Create a new comment
        $comment = Comment::create([
            'ticket_id' => $request->ticket_id,               
            'user_id' => $user->id,
            'user_idd' => $user->id,          
            'user_name' => $user->name,       
            'user_role' => $user->role,       
            'content' => $request->content, 
        ]);


        //---------send notif to user-----------
        if($Ticket->user_id != $user->id)
        {
        Notification::create([
            'user_id' => $Ticket->user_id, // The user who owns the ticket
            'title' => 'New comment on your ticket', // Notification title
            'content' => 'The ' . $user->name . " added a comment: [ " . $request->content . " ] to your ticket " . $Ticket->title,
            'sender_id' => $user->id, // ID of the sender
        ]);
    
        event(new NotificationEvent($Ticket->user_id, 'New Message', 'You have a new message!', $user->id));
        }
        //---------send notif to staff-----------

        if($Ticket->staff_id &&  $Ticket->staff_id != $user->id)
        {
            Notification::create([
            'user_id' => $Ticket->staff_id, // The user who owns the ticket
            'title' => 'New comment on your ticket', // Notification title
            'content' => 'The ' . $user->name . " added a comment: [ " . $request->content . " ] to your ticket " . $Ticket->title,
            'sender_id' => $user->id, // ID of the sender
        ]);

        event(new NotificationEvent($Ticket->staff_id, 'New Message', 'You have a new message!', $user->id));
        }

        //---------send notif to staff-----------

        event(new CommentAdded($comment));

        return back()->with('success', 'Comment added successfully!');
    }


    public function getNotifications(Request $request)
    {

        $user = auth()->user();
        $notifications = Notification::where('user_id', $user->id )->get();
        Notification::where('user_id', $user->id)->where('title', '!=', 'chat')->delete();
        return Inertia::render('utils/Notification', [
            'userName' => $user->name,
            'flash' => [
                'success' => session('success') 
            ],
            'notifications' => $notifications,
            ]);

    }
}
