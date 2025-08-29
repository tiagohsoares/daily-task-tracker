<?php

use App\Models\User;

it('should paginate all tasks from user', function () {
    $user  = User::factory()->create();
    $tasks = \App\Models\Task::factory()->create([]);

    $this->actingAs($user);

    $response = $this->get(route('dashboard'))
        ->assertViewHas('tasks', $tasks::query()
            ->orderBy('due_date')
            ->whereBelongsTo($user)
            ->paginate($perPage = 4));
});
