<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user       = Auth::user();
        $categories = Category::whereBelongsTo($user)->get();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('category.form', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, Task $task)
    {
        $user      = Auth::user();
        $validated = $request->validated();
        /**
         * abort_unless($user->can('store', $task), 403);.
         */
        Category::create([
            'name'    => $validated['name'],
            'user_id' => $user->id,
        ]);

        return redirect('category')->with('success', 'Categoria criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user     = Auth::user();
        $category = Category::findOrFail($id);

        abort_unless($user->can('show', $category), 403);

        return view('category.show', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $user     = Auth::user();
        $category = Category::findOrFail($id);
        abort_unless($user->can('update', $category), 403);

        $validated = $request->validated();

        Category::findOrFail($id)
            ->update([
                'name' => $validated['name'],
            ]);

        return redirect()->intended('category')->with('success', 'Categoria atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user     = Auth::user();
        $category = Category::findOrFail($id);

        abort_unless($user->can('destroy', $category), 403);
        Category::destroy($id);

        return redirect('category')->with('success', 'Categoria deletada!');
    }
}
