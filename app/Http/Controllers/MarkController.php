<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarkController extends Controller
{
  public function index()
  {
    $marks = Mark::all();

    return Inertia::render('Marks/Index', compact('marks'));
  }

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3', 'max:30', Rule::unique('marks', 'name')],
      'description' => ['required', 'min:6'],
    ]);

    Mark::create(
      [
        'name' => $formFields['name'],
        'description' => $formFields['description'],
        'author_id' => auth()->user()->id
      ],
    );

    return redirect('/marks')->with('message', 'Метка успешно создана');
  }

  public function edit($id)
  {
    $mark = Mark::findOrFail($id);
    return Inertia::render('Marks/Form', compact('mark'));
  }

  public function update(Request $request, $id)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3', 'max:30'],
      'description' => ['required', 'min:6'],
    ]);

    $mark = Mark::find($id);
    $mark->name = $formFields['name'];
    $mark->description = $formFields['description'];
    $mark->save();

    return redirect('/marks')->with('message', 'Метка успешно обновлена');
  }

  public function destroy($id)
  {
    $mark = Mark::find($id);

    if ($mark) {
      $mark->delete();
    }

    return back()->with('message', 'Метка успешно удалена');
  }
}
