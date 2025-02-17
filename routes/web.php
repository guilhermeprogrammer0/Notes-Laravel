<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\VerificaSeNaoLogado;
use App\Http\Middleware\VerificaLogado;

//Verifica se Não logado pra não permitir aparecer a página de login
Route::middleware([VerificaSeNaoLogado::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});
//Verifica se está logado para permitir aparecer a página principal
Route::middleware([VerificaLogado::class])->group(function(){
    Route::get('/index',[MainController::class,'index'])->name('home');
    Route::get('/newNote',[MainController::class,'newNote'])->name('new');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

