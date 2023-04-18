<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Dusk\Http\Controllers\UserController;

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

// Public
Route::post('/login', [AuthController::class, 'login']); // Login to API

// Protected
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Logout from API
    Route::post('/verzending/update/status', [DeliveryController::class, 'updateStatus']); // Update Delivery status of package
    Route::post('/verzending/aanmaken', [DeliveryController::class, 'store']); // Create a new delivery
});



















