<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la tâche</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        h1 { color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Modifier la tâche</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="title" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Statut</label>
            <select name="status">
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="form-group">
            <label>Priorité</label>
            <select name="priority">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Date limite</label>
            <input type="date" name="due_date" value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}">
        </div>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>