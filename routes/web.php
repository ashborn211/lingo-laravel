<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LingoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'update.last_seen'])->group(function () {
    Route::get('/lingo', [LingoController::class, 'index'])->name('lingo');
    Route::post('/guess', [LingoController::class, 'guess'])->name('lingo.guess');
    Route::get('/add-word', [LingoController::class, 'showAddWordForm'])->name('lingo.showAddWordForm');
    Route::post('/add-word', [LingoController::class, 'addWord'])->name('lingo.addWord');
    Route::post('/reset', [LingoController::class, 'reset'])->name('lingo.reset');
    Route::get('/leaderboard', [LingoController::class, 'leaderboard'])->name('leaderboard');

    Route::get('/dashboard', function () {
        return redirect()->route('lingo');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/add-friend', [FriendController::class, 'showAddFriendForm'])->name('friend');
    Route::post('/friend/send', [FriendController::class, 'sendFriendRequest'])->name('send-friend-request');
    Route::post('/friend/accept/{id}', [FriendController::class, 'acceptFriendRequest'])->name('friend.accept');
    Route::post('/friend/reject/{id}', [FriendController::class, 'rejectFriendRequest'])->name('friend.reject');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__ . '/auth.php';
