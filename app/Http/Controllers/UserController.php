<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function create()
  {
    return Inertia::render('Register');
  }
}
