<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Notification;
   use App\Models\AppSetting;

class Controllerroles extends Controller
{
    public function chekroles(Request $request)
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Redirect if no user is logged in
        }

        $user = Auth::user();
        //chek if loged user is admin
        if ($user->role == 'admin')
        {
            $AppSetting = AppSetting::first();

            if(!$AppSetting)
            {
                
                AppSetting::create([
                    'app_name' => 'Help Desk',
                    'key' => 'default', 
                    'color'=> 'lo',
                    'notifications'=> true,
                ]);
            }
            return Inertia::render('Admin', [
            'userName' => $user->name,  
            'flash' => [
                'success' => session('success') // Explicitly pass flash data
            ]
            ]);
        }


        //chek if loged user is supervisor
        elseif ($user->role == 'supervisor')
        {
            
            if($request->role)
            {
                $tickets = Ticket::where('status', $request->role)->get();
            }

            else{
            $tickets = Ticket::all();
            }
            $notifications = Notification::where('user_id', $user->id) // Fetch unread notifications
            ->get();

            return Inertia::render('supervisor', [
                'userName' => $user->name,
                'tickets' => $tickets,
                'selectedRole' =>$request->role,
                'flash' => [
                    'success' => session('success') // Explicitly pass flash data
                ],
                'notifications' => $notifications,
                ]);

        }

        

        //chek if loged user is staff
        elseif ($user->role == 'staff')
        {

            $tickets = Ticket::where('staff_id', $user->id)->get();
           // dd($tickets);
            return Inertia::render('staff', [
            'userName' => $user->name,
            'tickets' => $tickets,  
            'flash' => [
                'success' => session('success') // Explicitly pass flash data
            ]
            
            ]);
        }
        
        //chek if loged user is user
       elseif  ($user->role == 'user')
        {
            
            $tickets = Ticket::where('user_id', $user->id)->get();
           // dd($tickets);
            return Inertia::render('user', [
            'userName' => $user->name,
            'tickets' => $tickets,  
            'flash' => [
                'success' => session('success') // Explicitly pass flash data
            ]
            
            ]);
        }
    
    }
}
