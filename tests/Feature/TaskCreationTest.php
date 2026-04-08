<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    public function test_task_can_be_created()
    {
        $response = $this->post('/tasks', [
            'title' => 'Test Task',
        ]);

        $response->assertStatus(302);
    }
}
