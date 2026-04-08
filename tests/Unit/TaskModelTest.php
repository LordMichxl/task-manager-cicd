<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_has_fillable_attributes(): void
    {
        $task = Task::factory()->create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'todo',
            'priority' => 'high',
            'due_date' => '2025-12-31',
        ]);

        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('Test Description', $task->description);
        $this->assertEquals('todo', $task->status);
        $this->assertEquals('high', $task->priority);
        $this->assertEquals('2025-12-31', $task->due_date);
    }

    public function test_task_scope_by_status(): void
    {
        Task::factory()->create(['status' => 'todo']);
        Task::factory()->create(['status' => 'done']);
        Task::factory()->create(['status' => 'todo']);

        $todoTasks = Task::byStatus('todo')->get();

        $this->assertCount(2, $todoTasks);
        $this->assertTrue($todoTasks->every(fn($task) => $task->status === 'todo'));
    }

    public function test_task_factory_creates_valid_task(): void
    {
        $task = Task::factory()->create();

        $this->assertNotNull($task->id);
        $this->assertNotNull($task->title);
        $this->assertContains($task->status, ['todo', 'in_progress', 'done']);
        $this->assertContains($task->priority, ['low', 'medium', 'high']);
    }
}