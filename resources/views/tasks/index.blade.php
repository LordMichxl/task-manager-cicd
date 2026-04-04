<!DOCTYPE html>
<html>
<head>
    <title>Liste des tâches</title>
</head>
<body>

<h1>Liste des tâches</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('tasks.create') }}">Créer une tâche</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->id }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>

            <!-- Supprimer -->
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>

        </td>
    </tr>
    @endforeach
</table>

</body>
</html>