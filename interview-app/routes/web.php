<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

// List all users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Show form to create a new user
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Store a new user
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Show form to edit an existing user
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Update an existing user
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Delete a user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

