<?php

namespace App\Http\Controllers;

use App\Contracts\TaskContractService;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
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
    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $validated['name'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Categoria criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, TaskContractService $taskContractService)
    {
        $category = Category::where('id', $id)->where('user_id', Auth::id())->firstorFail();
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Category::where('id', $id)
            ->update([
                'name' => $request->name
            ]);

        return redirect()->intended('category')->with('success', 'categoria atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return redirect()->intended('category')->with('success', 'categoria deletada');
    }
}
