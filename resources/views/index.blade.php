<h1>Liste des tâches</h1>

@foreach($tasks as $task)
    <p>{{ $task->title }} - {{ $task->status }}</p>
@endforeach