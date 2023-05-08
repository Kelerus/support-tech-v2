<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TicketController::class, 'index'])->name('dashboard');
    Route::get('/ticket/item/{id}', [TicketController::class, 'show'])->name('ticket');
    Route::get('/create/ticket', [TicketController::class, 'create'])->name('ticket.create');

    Route::post('/create/ticket', [TicketController::class, 'store'])->name('ticket.post.create');
    Route::post('/ticket/addMessage', [TicketController::class, 'createMessage'])->name('ticket.addMessage');
    Route::post('/ticket/updateStatus', [TicketController::class, 'updateStatus'])->name('ticket.updateStatus');

    Route::middleware('role:admin|tech')->group(function () {
        Route::get('/ticket/users', [TicketController::class, 'showTicketsUsers'])->name('ticket.tech');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
