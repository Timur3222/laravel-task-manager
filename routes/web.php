<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;

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

Route::post('/statuses/store', [StatusController::class, 'store']);

Route::get('/statuses/{id}/edit', [StatusController::class, 'edit'])->middleware('auth');

Route::patch('/statuses/{id}/update', [StatusController::class, 'update'])->middleware('auth');

Route::delete('/statuses/{id}', [StatusController::class, 'destroy'])->middleware('auth');

//marks

Route::get('/marks', [MarkController::class, 'index']);

Route::get('/marks/create', function () {
  return Inertia::render('Marks/Form');
})->middleware('auth');

Route::post('/marks/store', [MarkController::class, 'store']);

Route::get('/marks/{id}/edit', [MarkController::class, 'edit'])->middleware('auth');

Route::patch('/marks/{id}/update', [MarkController::class, 'update'])->middleware('auth');

Route::delete('/marks/{id}', [MarkController::class, 'destroy'])->middleware('auth');

//tasks

Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/tasks/create', [TaskController::class, 'create'])->middleware('auth');

Route::get('/tasks/{id}', [TaskController::class, 'show']);

Route::post('/tasks/store', [TaskController::class, 'store']);

Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware('auth');

Route::patch('/tasks/{id}/update', [TaskController::class, 'update'])->middleware('auth');

Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth');
