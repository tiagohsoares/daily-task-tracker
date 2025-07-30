<?php

namespace App\Http\Controllers;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with("category")
            ->whereBelongsTo(Auth::user())
            ->orderBy('due_date')
            ->get();
        return view('dashboard', compact(['tasks']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('task.form', ['task' => new Task(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'nullable|string|max:255',
            'due_date'      => 'required|date_format:Y-m-d\TH:i',
            'status'        =>  ['required', new Enum(TaskStatus::class)],
            'frequency'     =>  ['required', new Enum(TaskFrequency::class)],
        ]);

        $tasks = Task::create([
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'due_date'      => $validated['due_date'],
            'status'        => $validated['status'],
            'frequency'     => $validated['frequency'],
            'user_id'       => Auth::id(),
            'category_id'   => $validated['category_id']
        ]);


        return redirect('dashboard')->with('success', 'Task criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstorFail();
        return view('task.show', compact(['task']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)    
    {
        Category::where('id', $id)
            ->updateOrFail([
                'title'         => $request->title,
                'description'   => $request->description,
                'due_date'      => $request->due_date,
                'status'        => $request->status,
                'frequency'     => $request->frequency,
            ]);

        return redirect('dashboard')->with('success', 'task atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::destroy($id);
        return redirect('dashboard')->with('success', 'task deletada');
    }
}
