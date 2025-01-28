<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectController;

Route::post('/prospects', [ProspectController::class, 'create']); // Create Prospect
Route::get('/prospects', [ProspectController::class, 'index']); // List Prospects
Route::get('/prospects/{id}', [ProspectController::class, 'show']); // Fetch Prospect by ID
Route::put('/prospects/{id}', [ProspectController::class, 'update']); // Update Prospect by ID
Route::delete('/prospects/{id}', [ProspectController::class, 'destroy']); // Delete Prospect by ID

