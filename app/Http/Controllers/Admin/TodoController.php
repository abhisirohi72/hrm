<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $main_title = "Admin-Todo-View";

        $title =    "View Todos";

        $todos = Todo::orderByDesc('created_at')->get();
        return view('admin.todos.view', compact('todos', 'title', 'main_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        // Create the todo
        $todo = Todo::create([
            'title' => $request->title,
        ]);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Task added successfully!',
            'data' => $todo
        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update(['is_completed' => $request->has('is_completed')]);
        return redirect()->back()->with('success', 'Todo updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('success', 'Todo deleted.');
    }
}
