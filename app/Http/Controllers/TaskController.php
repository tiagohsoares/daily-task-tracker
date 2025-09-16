<?php

namespace App\Http\Controllers;

use App\Contracts\PayloadService;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user  = auth()->user();
        $tasks = Task::whereBelongsTo($user)
            ->with(['category'])
            ->orderBy('due_date');

        if ($request->input('status')) {
            $tasks = $tasks->where('status', $request->input('status'));
        }

        if ($request->input('frequency')) {
            $tasks = $tasks->where('frequency', $request->input('frequency'));
        }

        $tasks = $tasks->paginate(5);

        return view('dashboard', compact(['tasks']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user       = auth()->user();
        $categories = Category::whereBelongsTo($user)->get();

        abort_unless($categories->isNotEmpty(), 403, 'Categoria não encontrada');

        return view('task.form', ['tasks' => new Task(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task)
    {

        $validated = $request->validated();

        app(PayloadService::class, ['payload' => $validated, 'model' => 'Task'])->create($task);

        return redirect('dashboard')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Category $category)
    {
        $task       = Task::findOrFail($id);
        $user       = auth()->user();

        abort_unless($user->can('update', $task), 403);

        $categories = Category::whereBelongsTo($user)->get();

        return view('task.show', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $user       = Auth::user();
        $task       = Task::findOrFail($id);

        abort_unless($user->can('update', $task), 403);

        $validated = $request->validated();

        app(PayloadService::class, ['payload' => $validated, 'model' => 'Task'])->update($task);

        return redirect()->back()->with('success', 'Tarefa atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user  = auth()->user();
        $task  = Task::findOrFail($id);

        abort_unless($user->can('destroy', $task), 403);

        Task::destroy($id);

        return redirect()->back()->with('success', 'Tarefa deletada');
    }
}
