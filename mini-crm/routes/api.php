<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

// Routes API pour les clients
Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::delete('/clients/{client}', [ClientController::class, 'destroy']);

