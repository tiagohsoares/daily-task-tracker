<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
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
    public function store(CategoryRequest $request)
    {
        /**
         * TODO: abort_unless($request->user()->can('store', $category), 403);.
         */
        $user      = Auth::user();
        $validated = $request->validated();

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
        $category = Category::whereBelongsTo($user)->findOrFail($id);

        return view('category.show', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {

        /**
         * TODO: abort_unless($request->user()->can('update', $category), 403);.
         */
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
        /**
         * TODO: abort_unless($request->user()->can('destroy', $category), 403);.
         */
        Category::destroy($id);

        return redirect('category')->with('success', 'Categoria deletada!');
    }
}
