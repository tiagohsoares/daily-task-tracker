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
        $tasks = Task::query()->whereBelongsTo($user)
            ->with(['category'])
            ->orderBy('due_date');

        if ($request->filled('status')) {
            $tasks = $tasks->where('status', $request->status);
        }
        if ($request->filled('frequency')) {
            $tasks = $tasks->where('frequency', $request->frequency);
        }

        $totalPending = $tasks->get()->filter(function ($task) {
            return $task->status === \App\Enums\TaskStatus::pending;
        })->count();

        $totalWeek = $tasks->get()->filter(function ($task) {
            return $task->due_date <= now()->addWeek();
        })->count();

        $totalCompleted = $tasks->get()->filter(function ($task) {
            return $task->status === \App\Enums\TaskStatus::completed;
        })->count();

        $tasks = $tasks->paginate(5)->withQueryString();

        return view('dashboard', compact(['tasks', 'totalPending', 'totalCompleted', 'totalWeek']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user       = auth()->user();
        $categories = Category::query()->whereBelongsTo($user)->get();

        abort_unless($categories->isNotEmpty(), 403, 'Categoria não encontrada');

        return view('task.form', ['tasks' => new Task(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task)
    {
        $validated            = $request->validated();
        $validated['user_id'] = Auth::id();

        app(PayloadService::class, ['payload' => $validated])->create($task);

        return redirect(route('dashboard'))->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Category $category)
    {
        $task       = Task::findOrFail($id);
        $user       = auth()->user();

        abort_unless($user->can('update', $task), 403);

        $categories = Category::query()->whereBelongsTo($user)->get();

        return view('task.show', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $user       = Auth::user();
        $task       = Task::query()->findOrFail($id);

        abort_unless($user->can('update', $task), 403);

        $validated            = $request->validated();
        $validated['user_id'] = $user->id;

        app(PayloadService::class, ['payload' => $validated])->update($task);

        return redirect(route('dashboard'))->with('success', 'Tarefa atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user  = auth()->user();
        $task  = Task::query()->findOrFail($id);

        abort_unless($user->can('destroy', $task), 403);

        Task::destroy($id);

        return redirect(route('dashboard'))->with('success', 'Tarefa deletada');
    }
}
