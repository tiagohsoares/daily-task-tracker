<?php

namespace App\Http\Controllers;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = DB::table('tasks')
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->where('tasks.user_id', '=', Auth::id())
            ->orderBy('due_date')
            ->get();
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.form', ['task' => new Task()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'due_date'      => 'required|date_format:Y-m-d H:i:s',
            'status'        =>  ['required', new \Illuminate\Validation\Rules\Enum(TaskStatus::class)],
            'frequency'     =>  ['required', new \Illuminate\Validation\Rules\Enum(TaskFrequency::class)],
        ]);

        $categories = Category::firstOrCreate([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
        ]);

        $tasks = Task::create([
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'due_date'      => $validated['due_date'],
            'status'        => $validated['status'],
            'frequency'     => $validated['frequency']
        ]);


        return redirect('dashboard')->with('success', 'Task criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tasks = Task::where('id', $id)->where('user_id', Auth::id())->firstorFail();
        return view('category.show', compact('tasks'));
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
