<?php

use App\Models\User;

it('can create a new category', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $category = [
        'name' => 'test category',
    ];

    $this->post(route('category.store'), $category)
        ->assertRedirect();

    $this->assertDatabaseHas('categories', data: [
        'user_id' => $user->id,
    ]);
});
