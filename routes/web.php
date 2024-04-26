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
Route::get('/event/update/{event_Id}',[EventController::class, 'updateView']);
Route::put('/updateEvent/{event_Id}', [EventController::class, 'update'])->name('updateEvent');
Route::get('/search', [EventController::class, 'search']);




//  ticket routes
Route::get('/tickets',[TicketController::class, 'show'])->name('viewAllTickets');
Route::get('/ticket/new/{event}',[TicketController::class, 'ticketDetails'])->middleware('auth');
Route::get('/ticket/{event_Id}',[TicketController::class, 'index']);
Route::post('/createTicket/{event_Id}',[TicketController::class, 'create']);


Route::get('/',[EventController::class, 'popularEvents']);
// Route::get('/',function() {
//     // $user= auth()->user();
//     // dump($user);
//     return view('home_event');});



















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
