<aside class="bg-white border-end" style="min-width: 220px;">
    <div class="p-3">
        <h5 class="text-dark">Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link text-dark" href="{{ route('tasks.index') }}"><i class="fas fa-list"></i> Toutes les tâches</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-dark" href="{{ route('tasks.create') }}"><i class="fas fa-plus"></i> Créer une tâche</a>
            </li>
        </ul>
    </div>
</aside>