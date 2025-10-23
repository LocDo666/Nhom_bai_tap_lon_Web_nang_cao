<?php
use App\Http\Controllers\Api\BookApiController;

Route::get('/books', [BookApiController::class, 'index']);
Route::get('/books/{book}', [BookApiController::class, 'show']);
