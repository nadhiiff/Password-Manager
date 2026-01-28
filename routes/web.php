<?php


use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

// Redirect root URL to our password manager index
Route::redirect('/', '/passwords');

// Resource routes for PasswordController
// This generates routes for index, create, store, edit, update, destroy, etc.
Route::resource('passwords', PasswordController::class);
