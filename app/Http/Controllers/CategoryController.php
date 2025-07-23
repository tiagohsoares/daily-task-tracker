<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\ViewCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    
    {
        $user = Auth::user();
        $categories = DB::select('select id, name from categories where user_id = :id', ['id' => $user->id]);
        return view('category', ['categories' => $categories]);
    }

    public function store() {}

    public function update() {}

    public function destroy() {}
}
