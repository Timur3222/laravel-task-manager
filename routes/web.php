<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
});

Route::get('/register', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);
