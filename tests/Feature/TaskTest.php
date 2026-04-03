<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    //Création d'une tâche
    public function test_can_create_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title'       => 'Ma première tâche',
            'description' => 'Description de ma tâche',
            'status'      => 'todo',
            'priority'    => 'high',
            'due_date'    => '2025-12-31',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Ma première tâche']);
    }

    //Liste des tâches
    public function test_can_list_tasks(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    //Voir le détail d'une tâche
    public function test_can_show_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', $task));

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    //Modification d'une tâche
    public function test_can_update_task(): void
    {
        $task = Task::factory()->create(['status' => 'todo']);

        $response = $this->put(route('tasks.update', $task), [
            'title'    => 'Titre modifié',
            'status'   => 'in_progress',
            'priority' => 'medium',
        ]);

        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseHas('tasks', [
            'id'     => $task->id,
            'title'  => 'Titre modifié',
            'status' => 'in_progress',
        ]);
    }

    //Suppression d'une tâche
    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    //Filtrage par statut
    public function test_can_filter_tasks_by_status(): void
    {
        Task::factory()->create(['status' => 'todo']);
        Task::factory()->create(['status' => 'done']);

        $response = $this->get(route('tasks.index', ['status' => 'todo']));

        $response->assertStatus(200);
        $response->assertSee('todo');
    }

    //Validation création titre obligatoire
    public function test_task_creation_requires_title(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title'    => '',
            'status'   => 'todo',
            'priority' => 'medium',
        ]);

        $response->assertSessionHasErrors('title');
    }
}