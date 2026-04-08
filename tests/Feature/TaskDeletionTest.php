<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_cannot_delete_nonexistent_task(): void
    {
        $response = $this->delete(route('tasks.destroy', 999));

        $response->assertStatus(404);
    }
}