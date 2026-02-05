<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Plays\CreatePlay;
use App\Livewire\Plays\PlayGame;
use App\Livewire\Plays\PreparePlay;
use App\Livewire\Plays\ScoreColumn;
use App\Livewire\Scores\ScoreHistory;
use App\Livewire\Subusers\AddSubuser;
use App\Livewire\Subusers\EditSubuser;
use App\Livewire\Subusers\ShowSubusers;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/settings.php';


Route::get('/members/show', ShowSubusers::class)->name('subusers.show');
Route::get('/members/{subuser}/edit', EditSubuser::class)->name('edit.subuser');
Route::get('/members/add', AddSubuser::class)->name('add.subuser');

Route::get('/play/create', CreatePlay::class)->name('play.create');
Route::get('/play/new-game', PlayGame::class)->name('play.game');
Route::get('/play/prepare', PreparePlay::class)->name('play.prepare');

Route::get('/score-history', ScoreHistory::class)->name('score.history');
