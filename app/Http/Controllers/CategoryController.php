<?php

namespace App\Http\Controllers;

use App\Contracts\TaskContractService;
use App\Http\Requests\Category\ViewCategoryRequest;
use App\Http\Requests\CategoryStoreRequest;
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
        return view('category.edit', ['categories' => $categories]);
    }

    public function store(int $id, CategoryStoreRequest $request, TaskContractService $TaskService) {
            $TaskService->findTask($id);
            $request->user();
            return view('category.edit', [$TaskService]);
    }

    public function update(CategoryStoreRequest $request, TaskContractService $TaskService) {
            $request->user();
            return view('category.edit', [$TaskService]);
    }

    public function destroy(int $id, CategoryStoreRequest $request, TaskContractService $TaskService) {}
}
