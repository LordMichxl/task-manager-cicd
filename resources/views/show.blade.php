@extends('layouts.app')

@section('title', 'Détail de la tâche')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-eye me-2"></i>Détail de la tâche</h2>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <label class="text-muted small text-uppercase fw-bold">Titre</label>
            <p class="fs-5 fw-semibold mb-0">{{ $task->title }}</p>
        </div>

        <hr>

        <div class="mb-3">
            <label class="text-muted small text-uppercase fw-bold">Description</label>
            <p class="mb-0">{{ $task->description ?? 'Aucune description.' }}</p>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="text-muted small text-uppercase fw-bold">Statut</label>
                <div class="mt-1">
                    @if($task->status === 'todo')
                        <span class="badge bg-secondary fs-6">À faire</span>
                    @elseif($task->status === 'in_progress')
                        <span class="badge bg-primary fs-6">En cours</span>
                    @elseif($task->status === 'done')
                        <span class="badge bg-success fs-6">Terminé</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <label class="text-muted small text-uppercase fw-bold">Priorité</label>
                <div class="mt-1">
                    @if($task->priority === 'low')
                        <span class="badge bg-secondary fs-6">Basse</span>
                    @elseif($task->priority === 'medium')
                        <span class="badge bg-warning text-dark fs-6">Moyenne</span>
                    @elseif($task->priority === 'high')
                        <span class="badge bg-danger fs-6">Haute</span>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label class="text-muted small text-uppercase fw-bold">Date limite</label>
            <p class="mb-0">
                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Aucune date limite.' }}
            </p>
        </div>

        <hr>

        <div class="row text-muted small">
            <div class="col-md-6">
                <i class="fas fa-calendar-plus me-1"></i>
                Créée le {{ $task->created_at->format('d/m/Y à H:i') }}
            </div>
            <div class="col-md-6">
                <i class="fas fa-calendar-check me-1"></i>
                Modifiée le {{ $task->updated_at->format('d/m/Y à H:i') }}
            </div>
        </div>

    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i> Modifier
    </a>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-list me-1"></i> Retour
    </a>
</div>
@endsection