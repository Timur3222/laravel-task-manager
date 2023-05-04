<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function create()
  {
    return Inertia::render('Register');
  }

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3'],
      'email' => ['required', 'email', Rule::unique('users', 'email')],
      'password' => 'required|confirmed|min:6'
    ]);

    $formFields['password'] = bcrypt($formFields['password']);

    $user = User::create($formFields);

    auth()->login($user);

    return redirect('/')->with('message', 'Успешная регистрация');
  }
}
