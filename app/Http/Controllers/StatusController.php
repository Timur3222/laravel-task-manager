<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatusController extends Controller
{
  public function index()
  {
    $statuses = Status::all();

    return Inertia::render('Statuses/Index', compact('statuses'));
  }

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3', Rule::unique('statuses', 'name')],
    ]);

    Status::create(
      [
        'name' => $formFields['name'],
        'author_id' => auth()->user()->id
      ],
    );

    return redirect('/statuses')->with('message', 'Статус успешно создан');
  }

  public function edit($id)
  {
    $status = Status::findOrFail($id);
    return Inertia::render('Statuses/Form', compact('status'));
  }

  public function update(Request $request, $id)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3', Rule::unique('statuses', 'name')],
    ]);

    $status = Status::findOrFail($id);
    $status->name = $formFields['name'];
    $status->save();

    return redirect('/statuses')->with('message', 'Статус успешно обновлен');
  }
}
