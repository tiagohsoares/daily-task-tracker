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
        //
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

        $category = Category::firstOrCreate([
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


        return redirect()->route('dashboard')->with('success', 'Categoria criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        Task::where('id', $id)
            ->update([
                'title' => $request->name
            ]);

        return redirect()->intended('category')->with('success', 'categoria atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::destroy($id);
        return redirect()->intended('dashboard')->with('success', 'task deletada');
    }
}
