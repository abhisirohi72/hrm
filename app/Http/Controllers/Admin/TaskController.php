<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $main_title= "Admin-Task-View";

        $title =    "Task View";

        $tasks = Task::all();
        
        return view('admin.tasks.view', compact('tasks', 'title', 'main_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $main_title= "Admin-Add-Task";

        $title =    "Add Task";

        $user_details = User::all();

        return view('admin.tasks.add', compact('title', 'main_title', 'user_details'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required|integer',
            'priority' => 'required',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        Task::create($data);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $main_title= "Admin-Edit-Task";

        $title =    "Edit Task";
        
        $user_details = User::all();
        
        $details = Task::findOrFail($id);

        return view('admin.tasks.add', compact('details', 'user_details', 'title', 'main_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required|integer',
            'priority' => 'required',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        $task->update($data);
        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
