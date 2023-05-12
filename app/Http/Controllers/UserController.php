<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3', 'max:25'],
      'email' => ['required', 'min:6', 'email', Rule::unique('users', 'email')],
      'password' => 'required|confirmed|min:6'
    ]);

    $formFields['password'] = bcrypt($formFields['password']);

    $user = User::create($formFields);

    auth()->login($user);

    return redirect('/')->with('message', 'Успешная регистрация');
  }

  public function logout(Request $request)
  {
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function authenticate(Request $request)
  {
    $formFields = $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    $remember_me = $request->input('remember_me');

    if (auth()->attempt($formFields, $remember_me)) {
      $request->session()->regenerate();

      return redirect('/');
    }

    return back()->withErrors(['email' => 'Неверный логин или пароль.']);
  }
}
