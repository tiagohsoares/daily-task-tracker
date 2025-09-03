<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Category $category): bool
    {
        return $category->user()->is($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $category->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, Category $category): bool
    {
        return $category->user()->is($user);
    }
}
