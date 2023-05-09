<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Status;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
  public function index(Request $request)
  {
    $tasks = Task::where(Arr::except($request->query(), ['page']))
    ->latest()
    ->paginate(10)
    ->withQueryString();
    $statuses = Status::all();
    $users = User::all();

    return Inertia::render('Tasks/Index', compact('tasks', 'statuses', 'users'));
  }

  public function show($id)
  {
    $task = Task::findOrFail($id);

    return Inertia::render('Tasks/Show', compact('task'));
  }

  public function create()
  {
    $statuses = Status::all();
    $users = User::all();
    $marks = Mark::all();

    return Inertia::render('Tasks/Form', compact('statuses', 'users', 'marks'));
  }

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'status' => ['required'],
      'name' => ['required', 'min:3', 'max:30', Rule::unique('tasks', 'name')],
    ]);

    Task::create(
      [
        'status' => $formFields['status'],
        'name' => $formFields['name'],
        'description' => $request->input('description'),
        'author_id' => auth()->user()->id,
        'doer_id' => $request->input('doer_id'),
        'marks' => $request->collect('marks'),
      ]
    );

    return redirect('tasks')->with('message', 'Задача успешно создана');
  }

  public function edit($id)
  {
    $statuses = Status::all();
    $users = User::all();
    $marks = Mark::all();
    $task = Task::findOrFail($id);

    return Inertia::render('Tasks/Form', compact('task', 'statuses', 'users', 'marks'));
  }

  public function update(Request $request, $id)
  {
    $formFields = $request->validate([
      'status' => ['required'],
      'name' => ['required', 'min:3', 'max:30'],
    ]);

    $task = Task::find($id);

    $task->fill($formFields);
    $task->description = $request->input('description');
    $task->doer_id = $request->input('doer_id');
    $task->marks = $request->collect('marks');

    $task->save();

    return redirect('/tasks')->with('message', 'Задача успешно обновлена');
  }

  public function destroy($id)
  {
    $task = Task::find($id);

    if ($task) {
      $task->delete();
    }

    return back()->with('message', 'Задача успешно удалена');
  }
}
