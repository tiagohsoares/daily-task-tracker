<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('dashboard', compact('tasks'));
    }
}
