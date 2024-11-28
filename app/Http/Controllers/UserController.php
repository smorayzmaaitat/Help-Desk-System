<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Events\PackageSent;
use App\Models\AppSetting;


class UserController extends Controller
{    public function show()
    {
        return Inertia::render('Counter');
    }

    public function increment()
    {
        
        $count = 10; // Fixed value of 10
        \Log::info('Broadcasting event with count: ' . $count);

        //Log::info('Broadcasting event with count: ' . $count);
        event(new PackageSent('string $s', 5));
               // dd("-------------->");
    }


    
    public function addUsers()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        if (!Auth::check()) {
            return redirect()->route('/');
        }
        return Inertia::render('utils/addusers', [
            // You can pass props here if needed
        ]);
    }

        public function store(Request $request)
        {
            // Validate the incoming request data
            try {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => ['required', 'confirmed'], // Password confirmation is required
                    'role' => 'required|string|in:user,staff,supervisor', // Validate the role
                ]);

            // Create the new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encrypt the password
                'role' => $request->role, // Set the role
            ]);
   
            } catch (\Illuminate\Validation\ValidationException $e) {
                dd($e->errors()); // Dump validation errors
            }
            session()->flash('success', 'User created successfully!');

            return redirect()->route('dashboard'); 
        }



        public function create_Ticket()
        {
            if (!Auth::check()) {
                return redirect()->route('/');
            }
            return Inertia::render('utils/Create_Ticket', [
                // You can pass props here if needed
            ]);
        }




        public function all_users()
        {
            $user = Auth::user();
            if ($user->role != 'admin') {
                abort(403, 'Unauthorized action.');
            }
            if (!Auth::check()) {
                return redirect()->route('/');
            }
            $users = User::select('id', 'name', 'email', 'role')
            ->where('id', '!=', $user->id)
            ->orderBy('name')
            ->get();
            return Inertia::render('utils/allusers', [
                'users' => $users,
                'flash' => [
                    'success' => session('success') 
                ]
            ]);

        }



            public function edit($id)
            {
                $user = Auth::user();
                if ($user->role != 'admin') {
                    abort(403, 'Unauthorized action.');
                }
                $user = User::findOrFail($id);
                
                return Inertia::render('utils/EditUser', [
                    'userData' => $user
                ]);
            }
        

            public function update(Request $request, $id)
            {
                $user = User::findOrFail($id);
                
                // Validate the request
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,'.$id,
                    'role' => 'required|in:user,admin,staff,supervisor',
                ]);
        
                // Update the user
                $user->update($validated);
                session()->flash('success', 'User updated successfully!');
                // Redirect back to users list with success message
                return redirect()->route('all_users');
            }

            public function delete(Request $request, $id)
            {
                $user = User::find($id);
                
                if ($user) {
                    // Delete the user
                    $user->delete();
                }
                // Redirect back to users list with success message
                return redirect()->route('all_users')
                    ->with('message', 'User deleted successfully');
            }

            public function app_sitting(Request $request)
            {
                $user = Auth::user();
                if ($user->role != 'admin') {
                    abort(403, 'Unauthorized action.');
                }
                return Inertia::render('utils/app_sitting', [
                    'userData' => $user,
                    'flash' => [
                        'success' => session('success') // Explicitly pass flash data
                    ]
                ]);
            }
            

            public function updateappsettings(Request $request)
            {
                $user = Auth::user();
                if ($user->role != 'admin') {
                    abort(403, 'Unauthorized action.');
                }
                $validated = $request->validate([
                    'name' => 'required|string|max:20',
                    'notifications' => 'required|boolean',
                    'themeColor' => 'required|string|max:255',
                ]);
                $AppSetting = AppSetting::first();
                if (!$AppSetting) {
                    return response()->json(['message' => 'App settings not found'], 404);
                }

                $AppSetting->update([
                    'app_name' => $validated['name'],
                    'notifications' => $validated['notifications'],
                    'color' => $validated['themeColor'],
                ]);

                session()->flash('success', 'App settings updated successfully!');

            }
            
}

