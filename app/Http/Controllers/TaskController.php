<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
  public function index(Request $request)
  {
    $tasks = Task::where($request->query())->get();
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
      'name' => ['required', 'min:3', Rule::unique('tasks', 'name')],
      'description' => ['min:6'],
    ]);

    Task::create(
      [
        'status' => $formFields['status'],
        'name' => $formFields['name'],
        'description' => $formFields['description'],
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
      'name' => ['required', 'min:3'],
      'description' => ['min:6'],
    ]);

    $task = Task::find($id);

    $task->fill($formFields);
    $task->doer_id = $request->input('doer_id');
    $task->marks = $request->collect('marks');

    $task->save();

    return redirect('/tasks')->with('message', 'Задача успешно обновлена');
  }

  public function delete($id)
  {
    $task = Task::find($id);

    if ($task) {
      $task->delete();
    }

    return back()->with('message', 'Задача успешно удалена');
  }
}
