<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

// Começa o jogo
Route::get ('/', [MainController::class, 'startGame'])-> name('startGame');
Route::post ('/', [MainController::class, 'prepareGame'])-> name('prepare_Game');


// Durante o jogo
Route::get('/game', [MainController::class,'game'])->name('game');
Route::get('/answer/{answer}', [MainController::class, 'answer'])->name('resposta');
Route::get('/next_question', [MainController::class, 'nextQuestion'])->name('next_question');

// Fim de jogo
Route::get('/show_resultados', [MainController::class, 'showResultados'])->name('show_resultados');
