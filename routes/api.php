<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\OwnerController;

use App\Http\Controllers\BlockController;
use App\Http\Controllers\AppartementController;


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



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/SignOut', [AuthController::class, 'SignOut'])->middleware('auth:sanctum');
Route::get('blocks/{block}/apartments', [BlockController::class, 'apartments']);


Route::get('/blocks/count', [BlockController::class, 'count']);
Route::get('/blocks', [BlockController::class, 'index']);
Route::post('/blocks', [BlockController::class, 'store']);
Route::put('/blocks/{id}', [BlockController::class, 'update']); // Use {id} to capture block ID
Route::delete('/blocks/{id}', [BlockController::class, 'destroy']); // Use {id} to capture block ID


// Appartements Routes
Route::get('/appartements', [AppartementController::class, 'index']);
Route::post('/appartements', [AppartementController::class, 'store']);
Route::get('/appartements/{id}', [AppartementController::class, 'show']);
Route::put('/appartements/{id}', [AppartementController::class, 'update']);
Route::delete('/appartements/{id}', [AppartementController::class, 'destroy']);
