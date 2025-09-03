<?php

namespace App\Http\Controllers;

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

        abort_unless($categories, 403);

        $tasks = Task::whereBelongsTo($user)->with('category')->get();

        return view('task.form', compact('categories', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task)
    {

        $validated = $request->validated();
        $user      = Auth::user();

        Task::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'due_date'    => $validated['due_date'],
            'status'      => $validated['status'],
            'frequency'   => $validated['frequency'],
            'user_id'     => $user->id,
            'category_id' => $validated['category_id'],
        ]);

        return redirect('dashboard')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user       = Auth::user();
        $task       = Task::whereBelongsTo($user)->findOrFail($id);
        $categories = Category::whereBelongsTo($user)->get();

        return view('task.show', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        abort_unless($request->user()->can('update', $task), 403);

        $validated = $request->validated();

        Task::findOrFail($task)
            ->update([
                'title'       => $validated['title'],
                'description' => $validated['description'],
                'due_date'    => $validated['due_date'],
                'status'      => $validated['status'],
                'frequency'   => $validated['frequency'],
            ]);

        return redirect('dashboard')->with('success', 'Tarefa atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user  = Auth::user();
        abort_unless($user->can('destroy'), 404);
        Task::destroy($id);

        return redirect('dashboard')->with('success', 'Tarefa deletada');
    }
}
