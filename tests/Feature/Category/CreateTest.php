<?php

use App\Models\Category;
use App\Models\User;
use function Pest\Laravel\assertDatabaseHas;


function post(string $route)
{

}

it('can create a new category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();


    $this->actingAs($user);

    post(route('category.store', $category));

        $this->assertDatabaseHas('categories', data: [
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
        ]);
});
