<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskEditTest extends TestCase
{
    use RefreshDatabase;

    /** 1. Test de modification réussie */
    public function test_task_can_be_updated()
    {
        $task = Task::factory()->create(['title' => 'Ancien Titre']);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Titre Modifie',
            'status' => 'in_progress', // Aligné sur ta migration
            'priority' => 'high'
        ]);

        // Ton contrôleur fait un return redirect(), donc on teste la redirection
        $response->assertRedirect(); 
        $this->assertDatabaseHas('tasks', ['title' => 'Titre Modifie']);
    }

    /** 2. Test de validation : Titre requis */
    public function test_update_requires_a_title()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", [
            'title' => '', 
            'status' => 'done',
            'priority' => 'medium'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** 3. Test de validation : Longueur du titre */
    public function test_update_title_cannot_exceed_255_characters()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", [
            'title' => str_repeat('a', 256),
            'status' => 'todo',
            'priority' => 'low'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** 4. Test de modification d'une tâche inexistante */
    public function test_update_fails_for_non_existent_task()
    {
        $response = $this->put("/tasks/999", [
            'title' => 'Inexistant',
            'status' => 'todo',
            'priority' => 'low'
        ]);

        $response->assertStatus(404);
    }

    /** 5. Test des valeurs Enum */
    public function test_update_fails_with_invalid_status()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Titre OK',
            'status' => 'invalid-status', // Ne passera pas la validation 'in:todo,in_progress,done'
            'priority' => 'low'
        ]);

        $response->assertSessionHasErrors('status');
    }
}