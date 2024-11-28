<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controllerroles;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;

// Landing page route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('/');

// ------------------- Routes with 'auth' middleware -------------------
Route::middleware('auth')->group(function () {
    
    // Comments Routes
    Route::post('/addcomments', [CommentController::class, 'store']);
    Route::get('/notifications', [CommentController::class, 'getNotifications']);
    
    // Settings Routes
    Route::get('/appsitting', [UserController::class, 'app_sitting']);
    Route::post('/update-app-settings', [UserController::class, 'updateappsettings']);
    
    // Chat Routes
    Route::get('/alluserschat', [ChatController::class, 'alluserschat'])->name('alluserchat');
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/messages_send', [ChatController::class, 'messages_send'])->name('send');
    
    // Ticket Management Routes
    Route::post('/deleteticket/{id}', [TicketController::class, 'deleteticket']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/alltickitadmin', [TicketController::class, 'viewallticketsForadmin']);
    Route::get('/edittickets/{id}', [TicketController::class, 'edit']);
    Route::post('/updteckets/{id}', [TicketController::class, 'update']);
    Route::get('/viewtickets/{id}', [TicketController::class, 'viewtickets']);
    Route::post('/tickets/feedback', [TicketController::class, 'feedback']);
    Route::post('/tickets/assign-staff', [TicketController::class, 'assign_staff']);
    Route::post('/tickets/staff_updateticket', [TicketController::class, 'staff_updateticket']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Management Routes
    Route::get('/addusers', [UserController::class, 'addUsers'])->name('addusers.addUsers');
    Route::post('/addusers', [UserController::class, 'store'])->name('addusers.store');
    Route::get('/dashboard', [Controllerroles::class, 'chekroles'])->name('dashboard');
    Route::get('/create-ticket', [UserController::class, 'create_Ticket'])->name('create_Ticket');
    Route::get('/all_users', [UserController::class, 'all_users'])->name('all_users');
    Route::get('/edituser/{id}', [UserController::class, 'edit'])->name('users.edituser');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::put('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
});


// Authentication routes
require __DIR__ . '/auth.php';

