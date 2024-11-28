<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Comment;
use App\Events\CommentAdded;
use App\Events\NotificationEvent;
use App\Models\Notification;

class TicketController extends Controller
{
    public function create()
{
    return Inertia::render('CreateTicket', [
        'categories' => ['Hardware', 'Software', 'Network', 'Other'],
    ]);
}

public function store(Request $request)
{
   // dd($request['attachment']);
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'category' => 'required',
        'priority' => 'required',
        'department' => 'required',
        'attachment' => 'nullable',
    ]);
    $user = Auth::user();


   // dd($user->id);
    $ticket = Ticket::create([
        'user_id' => $user->id,
        'title' => $validated['title'],
        'description' => $validated['description'],
        'category' => $validated['category'],
        'priority' => $validated['priority'],
        'department' => $validated['department'],
        'attachment' => $request->file('attachment')?->store('attachments', 'public'),
    ]);


    session()->flash('success', 'ticket created successfully!');

    return redirect()->route('dashboard');
}



public function edit(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $user = Auth::user();
    if ($user->id != $ticket->user_id)
    {
        abort(403, 'Unauthorized action.');
    }
   // dd($ticket);
    return Inertia::render('utils/EditTicket', [
        'ticket' => $ticket
    ]);
}


public function update(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $user = Auth::user();
    if ($user->id != $ticket->user_id)
    {
        abort(403, 'Unauthorized action.');
    }
    try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'attachment' => 'nullable|max:10240',  // Optional attachment, max size of 10MB
        ]);
    } catch (ValidationException $e) {
        // Handle the validation exception
        $errors = $e->errors();  // Retrieve the validation errors
        dd($errors);
    }


    $ticket->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'category' => $validated['category'],
        'priority' => $validated['priority'],
        'department' => $validated['department'],
        'attachment' => $request->file('attachment')?->store('attachments', 'public'),
    ]);

    return redirect()->route('dashboard');
}



public function viewtickets(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $comments = Comment::where('ticket_id', $ticket->id)->get();
    $user = Auth::user();
    
    if ($user->role == 'supervisor')
    {
        $staffList = User::where('role' , 'staff')->get();

        //dd($staffList);
        return Inertia::render('utils/soperviewstatus', [
            'tickets' => [$ticket],
            'staffList' => $staffList,
            'comments' => $comments,
        ]);
    }


    if ($user->role == 'staff')
    {

        return Inertia::render('utils/staffviewstatus', [
            'tickets' => [$ticket],
            'comments' => $comments,
        ]);
    }
    if ($user->role == 'admin')
    {

        return Inertia::render('utils/adminviestatus', [
            'tickets' => [$ticket],
            'comments' => $comments,
        ]);
    }
    
    if ($user->id != $ticket->user_id)
    {
        abort(403, 'Unauthorized action.');
    }

    return Inertia::render('utils/ViewTicketStatus', [
        'tickets' => [$ticket],
        'comments' => $comments,
    ]);
  
}


public function feedback(Request $request)
{
    $id = $request->ticket_id;
    $ticket = Ticket::findOrFail($id);
    $user = Auth::user();
    $feedback = $request->feedback;
   // dd($feedback );
    if ($user->id != $ticket->user_id)
    {
        abort(403, 'Unauthorized action.');
    }
    $ticket->update([
        'feedback' => $request->feedback]);
        return redirect()->route('viewtickets', ['id' => $id]);
  
}


public function assign_staff(Request $request)
{
    $id = $request->ticket_id;
    $staff_id = $request->staff_id;
    $ticket = Ticket::findOrFail($id);
    $user = User::where('id',$staff_id)->first();
    $thisuser = Auth::user();

    if ($user->id != $ticket->user_id && $thisuser->role != 'supervisor')
    {
        abort(403, 'Unauthorized action.');
    } 

Notification::create([
        'user_id' => $request->staff_id,
        'title' => 'new ticket assigned to you',
        'content' => 'new ticket [ '.$ticket->title.' ] assigned to you from '. $thisuser->name,
        'sender_id' => $thisuser->id,
    ]);

    event(new NotificationEvent($request->staff_id, 'New Message', 'You have a new message!', $thisuser->id));
    
    $ticket->update([
        'staff_id' => $staff_id,
        ''
        ]);

        return redirect()->route('viewtickets', ['id' => $id]);
  
}


public function staff_updateticket(Request $request)
{
    $id = $request->ticket_id;
    $ticket = Ticket::findOrFail($id);
    $user = Auth::user();
    $staff_id = $user->id;
    // Check if the user exists and is authorized
    if ( ($user->id != $ticket->user_id && 
                   $user->id != $ticket->staff_id)) {
        abort(403, 'Unauthorized action.');
    }

    if ($request->status == 'resolved') {
        $ticket->update([
            'staff_id' => $staff_id ,
            'checked_by' => $user->name ?? '',
            'status' => $request->status ?? '',
            'staff_notes' => $request->staff_note ?? '',
            'staff_solutions' => $request->staff_solutions ?? '',
            'resolved_by' => $user->name,
            'resolved_at' => now(),
            //'time_to_resolve' => now()->diffInMinutes($ticket->created_at),
        ]);
    } else {
        $ticket->update([
            'staff_id' => $staff_id,
            'checked_by' => $user->name,
            'status' => $request->status ?? '',
            'staff_notes' => $request->staff_note ?? '',
            'staff_solutions' => $request->staff_solutions ?? '',
        ]);
    }

    return redirect()->route('viewtickets', ['id' => $id]);
}


public function viewallticketsForadmin(Request $request)
{

    $user = Auth::user();
    if($request->role)
    {
      // dd($request->role);
        $tickets = Ticket::where('status', $request->role)->get();
    }

    else{
        $tickets = Ticket::all();
    }
    return Inertia::render('utils/adminviewtickets', [
        'userName' => $user->name,
        'tickets' => $tickets,
        'selectedRole' =>$request->role,
        'flash' => [
            'success' => session('success') // Explicitly pass flash data
        ]
        ]);



}


public function deleteticket(Request $request , $id)
{
    $user = Auth::user();
    if ($user->role != 'admin') {
        abort(403, 'Unauthorized action.');
    }
    if (!Auth::check()) {
        return redirect()->route('/');
    }
    $tickets = Ticket::where('id', $id)->delete();
}

}
