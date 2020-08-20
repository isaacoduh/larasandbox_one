<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate(5);
        return view('tasks')->with('tasks', $tasks);
    }

    /**
     * Store a newly create resource
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'task' => 'required',
            'description' => 'required',
        ));

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'messages' => $validator->errors()
            ],422);
        }

        $task = Task::create($request->all());

        return response()->json([
            'error' => false,
            'task' => $task
        ],200);
    }

    public function show($id)
    {
        $task = Task::find($id);

        return response()->json([
            'error' => false,
            'task' => $task,
        ],200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'task' => 'required',
            'description' => 'required'
        ));

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'messages' => $validator->errors(),
            ],422);
        }

        $task = Task::find($id);
        $task->task = $request->input('task');
        $task->description = $request->input('description');
        $task->save();

        return response()->json([
            'error' => false,
            'task' => $task
        ],200);
    }

    public function destroy($id)
    {
        $task = Task::destroy($id);
        return response()->json([
            'error' => false,
            'task' => $task
        ],200);
    }

}
