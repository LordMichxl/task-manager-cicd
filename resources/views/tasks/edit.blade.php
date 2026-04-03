<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $task->title }}" required>
    <textarea name="description">{{ $task->description }}</textarea>

    <select name="status">
        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
    </select>

    <select name="priority">
        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
    </select>

    <input type="date" name="due_date" value="{{ $task->due_date }}">

    <button type="submit">Mettre à jour</button>
</form>