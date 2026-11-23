<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

Route::apiResource('media', MediaController::class);

Route::post('media/{id}/add-to-collection', [MediaController::class, 'addToCollection']);
Route::post('media/{id}/remove-from-collection', [MediaController::class, 'removeFromCollection']);
