<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Events\PackageSent;
use App\Models\AppSetting;
use App\Models\Message;
use App\Events\NotificationEvent;
use App\Events\MessageSent;
use App\Models\Notification;

class ChatController extends Controller
{
    public function chat(Request $request ,  $id)
    {
        $receiver = User::findOrFail($id);
        $user = Auth::user();
        $senderId = $user->id;
        $receiverId = $receiver->id;
        $chatId = min($senderId, $receiverId) . '_' . max($senderId, $receiverId);
        $messages = Message::where('message_id', $chatId)
        ->orderBy('id', 'asc')
        ->get();      
        Notification::where('sender_id',$receiverId)->delete();
        return Inertia::render('chat', [
            'receiver' => $receiver,
            'flash' => [
                'success' => session('success') 
            ],
            'messages' => $messages,
        ]);
    }

    public function messages_send(Request $request )
    {
        // Validate incoming data
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Optional image upload
        ]);

       
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Store the new message
        // $messages = Message::where('chat_id', $chatId)
        // ->orderBy('id', 'asc')
        // ->get(); 
        $receiverId = $request->receiver_id;
        $user = Auth::user();
        $senderId = $user->id;
        $chatId = min($senderId, $receiverId) . '_' . max($senderId, $receiverId);
        $message = Message::create([
            'message_id' => $chatId ,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $request->content,
            'image' => $imagePath,
        ]);


        Notification::create([
            'user_id' => $receiverId, 
            'title' => 'chat', 
            'content' => 'The ' . $user->name . " send you: [ " . $request->content . " ] ",
            'sender_id' => $senderId, // ID of the sender
        ]);

        
        event(new NotificationEvent($receiverId, 'chat', 'You have a new message!', $senderId ));
        event(new MessageSent($message));
    }




    public function alluserschat(Request $request)
    {
        $user = Auth::user();


        if (!Auth::check()) {
            return redirect()->route('/');
        }
        $users = User::select('id', 'name', 'email', 'role')
        ->where('id', '!=', $user->id)
        ->orderBy('name')
        ->get();
        return Inertia::render('utils/alluserschat', [
            'users' => $users,
            'flash' => [
                'success' => session('success') 
            ]
        ]);

    }
}