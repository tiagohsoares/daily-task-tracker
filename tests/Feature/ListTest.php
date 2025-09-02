<?php

use App\Models\Task;
use App\Models\User;

it('should paginate all tasks from user', function () {
    $user  = User::factory()->create();

    $this->actingAs($user);

    $tasks = Task::factory()->count(10)->create();

    $response = $this->get(route('dashboard'))
        ->assertViewHas(
            'tasks', Task::whereBelongsTo($user)
                ->paginate(5)
        );
});
