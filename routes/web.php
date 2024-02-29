<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Auth0\Laravel\Facade\Auth0;
use Illuminate\Support\Facades\Route;

// events routes
Route::get('/events', [EventController::class, 'show'])->name('events');
Route::get('/event/new', function() { return view('newEvent'); })->name('newEvent');
Route::get('/event/{event_Id}', [EventController::class, 'index'])->name('event');
Route::post('/createEvent', [EventController::class, 'create'])->name('createEvent');



//  ticket routes
Route::get('/tickets',[TicketController::class, 'show']);
// Route::get('/ticket/new/{event}', function($event) {return view('newTicket', ['event_Id' => $event]);});
Route::get('/ticket/new/{event}',[TicketController::class, 'ticketDetails']);
Route::get('/ticket',[TicketController::class, 'index']);
Route::post('/createTicket/{event_Id}',[TicketController::class, 'create']);



Route::get('/',function() {
    // $user= auth()->user();
    // dump($user);
    return view('home_event');});

















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
