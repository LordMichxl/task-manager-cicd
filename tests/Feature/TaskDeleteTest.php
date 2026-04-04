<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can delete their own task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)
                     ->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $response->assertSessionHas('success', 'Tâche supprimée avec succès.');

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('user cannot delete another users task', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->actingAs($user)
                     ->delete(route('tasks.destroy', $task));

    $response->assertStatus(403); // Forbidden

    $this->assertDatabaseHas('tasks', ['id' => $task->id]);
});

test('guest cannot delete task', function () {
    $task = Task::factory()->create();

    $response = $this->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas('tasks', ['id' => $task->id]);
});
