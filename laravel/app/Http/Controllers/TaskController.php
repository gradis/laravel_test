<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed'
        ]);

        $task = Task::create($data);
        return response()->json($task);
    }

    public function index(){
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function show(int $id) {
        $task = Task::find($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function update(int $id, Request $request) {
        $task = Task::find($id);
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed'
        ]);

        $task->update($data);

        return response()->json($task);
    }

    public function destroy(int $id) {
        $task = Task::find($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task successfully deleted']);
    }
}
