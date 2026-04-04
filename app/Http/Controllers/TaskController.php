<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'in:todo,in_progress,done',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date'
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')
                        ->with('success','Task créée avec succès.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'in:todo,in_progress,done',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date'
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
                        ->with('success','Task mise à jour.');
    }

    // ✅ SUPPRESSION
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
                        ->with('success', 'Tâche supprimée avec succès.');
    }
}