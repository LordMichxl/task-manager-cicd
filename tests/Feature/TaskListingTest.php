<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_tasks(): void
    {
        Task::factory()->count(5)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewHas('tasks', function ($tasks) {
            return $tasks->count() === 5;
        });
    }
}