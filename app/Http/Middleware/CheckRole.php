<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\AppSetting;
use App\Models\Notification;
use App\Models\Ticket;

class CheckRole
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            // Redirect if no user is logged in
            return redirect()->route('login');
        }

        switch ($user->role) {
            case 'admin':
                $appSetting = AppSetting::first();

                if (!$appSetting) {
                    AppSetting::create([
                        'app_name' => 'Help Desk',
                        'key' => 'default',
                        'color' => 'lo',
                        'notifications' => true,
                    ]);
                }

                return Inertia::render('Admin', [
                    'userName' => $user->name,
                    'flash' => [
                        'success' => session('success'),
                    ],
                ]);

            case 'supervisor':
                $tickets = $request->role
                    ? Ticket::where('status', $request->role)->get()
                    : Ticket::all();

                $notifications = Notification::where('user_id', $user->id)->get();

                return Inertia::render('supervisor', [
                    'userName' => $user->name,
                    'tickets' => $tickets,
                    'selectedRole' => $request->role,
                    'flash' => [
                        'success' => session('success'),
                    ],
                    'notifications' => $notifications,
                ]);

            case 'staff':
                $tickets = Ticket::where('staff_id', $user->id)->get();

                return Inertia::render('staff', [
                    'userName' => $user->name,
                    'tickets' => $tickets,
                    'flash' => [
                        'success' => session('success'),
                    ],
                ]);

            case 'user':
                $tickets = Ticket::where('user_id', $user->id)->get();

                return Inertia::render('user', [
                    'userName' => $user->name,
                    'tickets' => $tickets,
                    'flash' => [
                        'success' => session('success'),
                    ],
                ]);

            default:
                return redirect()->route('login');
    }
}

}
