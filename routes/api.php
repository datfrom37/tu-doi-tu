<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextProcessingController;

Route::post('/process-text', [TextProcessingController::class, 'processText']);
Route::post('/uppercase', [TextProcessingController::class, 'uppercase']);
Route::post('/sentence-case', [TextProcessingController::class, 'sentenceCase']);
