<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

// Começa o jogo
Route::get ('/', [MainController::class, 'startGame'])-> name('startGame');
Route::post ('/', [MainController::class, 'prepareGame'])-> name('prepare_Game');


// Durante o jogo
Route::get('/game', [MainController::class,'game'])->name('game');