<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\MarkController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Index');
});

//authorization

Route::get('/login', function () {
  return Inertia::render('Login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
  return Inertia::render('Register');
})->middleware('guest');

Route::post('/users/register', [UserController::class, 'store']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);

//statuses

Route::get('/statuses', [StatusController::class, 'index']);

Route::get('/statuses/create', function () {
  return Inertia::render('Statuses/Form');
})->middleware('auth');

Route::get('/statuses/{id}/edit', [StatusController::class, 'edit'])->middleware('auth');

Route::post('/statuses/store', [StatusController::class, 'store']);

Route::patch('/statuses/{id}/update', [StatusController::class, 'update'])->middleware('auth');

Route::delete('/statuses/{id}', [StatusController::class, 'delete'])->middleware('auth');

//marks

Route::get('/marks', [MarkController::class, 'index']);

Route::get('/marks/create', function () {
  return Inertia::render('Marks/Form');
})->middleware('auth');

Route::get('/marks/{id}/edit', [MarkController::class, 'edit'])->middleware('auth');

Route::post('/marks/store', [MarkController::class, 'store']);

Route::patch('/marks/{id}/update', [MarkController::class, 'update'])->middleware('auth');

Route::delete('/marks/{id}', [MarkController::class, 'delete'])->middleware('auth');

//tasks

Route::get('/tasks', function () {
  return Inertia::render('Tasks');
});