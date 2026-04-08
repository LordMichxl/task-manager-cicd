@extends('layouts.app')

@section('title', 'Modifier la tâche')

@section('content')
<div style="max-width: 600px; margin: 50px auto;">
    <h1>Modifier la tâche</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="title" value="{{ $task->title }}" required class="form-control">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Statut</label>
            <select name="status" class="form-control">
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="form-group">
            <label>Priorité</label>
            <select name="priority" class="form-control">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Date limite</label>
            <input type="date" name="due_date" 
                   value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}" 
                   class="form-control">
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection