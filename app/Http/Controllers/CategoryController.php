<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\ViewCategoryRequest;
use App\Models\Categories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(ViewCategoryRequest $request) {
        return auth()->user()->can('isFeio', Categories::class);
    }

    public function create() {}

    public function update() {}

    public function destroy() {}
}
