<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route de login
Route::post('/login', [AuthController::class, 'login']);

// Routes pour les propriétaires
Route::get('/owners', [OwnerController::class, 'index']);
Route::post('/owners', [OwnerController::class, 'store']);
Route::get('/owners/{id}', [OwnerController::class, 'show']);
Route::put('/owners/{id}', [OwnerController::class, 'update']);
Route::delete('/owners/{id}', [OwnerController::class, 'destroy']);

