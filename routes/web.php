<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index');
});

Route::get('/tasks', function () {
    return Inertia::render('Tasks');
});

Route::get('/statuses', function () {
    return Inertia::render('Statuses');
});

Route::get('/marks', function () {
    return Inertia::render('Marks');
});

Route::get('/login', function () {
    return Inertia::render('Login');
})->middleware('guest');

Route::get('/register', function () {
    return Inertia::render('Register');
})->middleware('guest');

//POST methods

Route::post('/users/register', [UserController::class, 'store']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);