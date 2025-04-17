<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplacementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SrtConvertController;
use Illuminate\Support\Facades\Auth;


Route::middleware('auth')->group(function () {
    Route::get('/', [ReplacementController::class, 'index']);
    Route::post('/process-text', [ReplacementController::class, 'processText'])->name('process.text');
    // Route để xử lý xóa từ

    Route::get('/add-word', [ReplacementController::class, 'addWordForm'])->name('add.word');
    Route::post('/add-word', [ReplacementController::class, 'store'])->name('add.word.store');
    Route::delete('/delete-word/{id}', [ReplacementController::class, 'destroy'])->name('delete.word');
    // Route để xóa nhiều từ
    Route::delete('/delete-words', [ReplacementController::class, 'deleteMultiple'])->name('delete.words');
    

    Route::get('/convert-srt', [SrtConvertController::class, 'index'])->name('srt.index');
    Route::post('/convert-srt', [SrtConvertController::class, 'convert'])->name('srt.convert');



});
    // Routes cho login, register
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');




