<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Index');
});

Route::get('/tasks', function () {
  return Inertia::render('Tasks');
});

Route::get('/marks', function () {
  return Inertia::render('Marks');
});

Route::get('/login', function () {
  return Inertia::render('Login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
  return Inertia::render('Register');
})->middleware('guest');

Route::get('/statuses', [StatusController::class, 'index']);

Route::get('/statuses/create', function () {
  return Inertia::render('Statuses/Form');
})->middleware('auth');

Route::get('/statuses/{id}/edit', [StatusController::class, 'edit'])->middleware('auth');

//POST methods

Route::post('/users/register', [UserController::class, 'store']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/statuses/store', [StatusController::class, 'store']);

//PATCH methods

Route::patch('/statuses/{id}/update', [StatusController::class, 'update'])->middleware('auth');
