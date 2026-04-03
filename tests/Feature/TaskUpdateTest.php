<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->put(route('tasks.update', $task), [
            'title'    => 'Titre modifié',
            'status'   => 'in_progress',
            'priority' => 'high',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Titre modifié']);
    }

    public function test_update_fails_without_title(): void
    {
        $task = Task::factory()->create();

        $response = $this->put(route('tasks.update', $task), [
            'title'  => '',
            'status' => 'done',
        ]);

        $response->assertSessionHasErrors('title');
    }
}