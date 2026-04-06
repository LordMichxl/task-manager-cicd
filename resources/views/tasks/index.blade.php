@extends('layouts.app')

@section('title', 'Liste des tâches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Liste des tâches</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvelle tâche
    </a>
</div>

@if ($tasks->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Aucune tâche disponible pour l’instant.
    </div>
@else
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead class="table-dark text-white">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priorité</th>
                    <th>Échéance</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td class="text-truncate" style="max-width:280px;">{{ \Illuminate\Support\Str::limit($task->description, 70) }}</td>
                    <td>
                        @php
                        $statusClass = match ($task->status) {
                            'done' => 'success',
                            'in_progress' => 'warning',
                            default => 'secondary',
                        };
                        $statusLabel = match ($task->status) {
                            'done' => 'Terminé',
                            'in_progress' => 'En cours',
                            default => 'À faire',
                        };
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ $statusLabel }}</span>
                    </td>
                    <td>
                        @php
                        $priorityClass = match ($task->priority) {
                            'high' => 'danger',
                            'medium' => 'warning text-dark',
                            default => 'info text-dark',
                        };
                        $priorityLabel = match ($task->priority) {
                            'high' => 'Haute',
                            'medium' => 'Moyenne',
                            default => 'Basse',
                        };
                        @endphp
                        <span class="badge {{ $priorityClass }}">{{ $priorityLabel }}</span>
                    </td>
                    <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : '—' }}</td>
                    <td> <a href="{{ route('task.edit', $task->id) }}" class="btn btn-info btn-sm">Modifier</a> <t

                    <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression de cette tâche ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
