<?php

namespace Database\Factories;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'category_id' => Category::factory(),
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'due_date'    => now()->addDays(rand(1, 10)),
            'frequency'   => $this->faker->randomElement(TaskFrequency::class),
            'status'      => $this->faker->randomElement(TaskStatus::class),
        ];
    }
}
