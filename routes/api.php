<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CallDetailController;
// This route will be accessible at http://127.0.0.1:8000/api
Route::get('/', function () {
    return response()->json(['message' => 'Request GET success']);
});

// Other API routes with the /api prefix automatically applied
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

Route::prefix('call_details')->group(function () {
    Route::get('/', [CallDetailController::class, 'index']);  // Get all call details
    Route::get('{id}', [CallDetailController::class, 'show']); // Get a single call detail
    Route::post('/', [CallDetailController::class, 'store']);   // Create a new call detail
    Route::put('{id}', [CallDetailController::class, 'update']); // Update a call detail
    Route::delete('{id}', [CallDetailController::class, 'destroy']); // Delete a call detail
});