<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return view('home')->with(compact('task'));
    }

    /**
     * Store a newly create resource
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task' => 'required|max:255',
            'description' => 'required'
        ]);
        $task = Task::create($data);
        return response()->json($task, 201);
    }

}
