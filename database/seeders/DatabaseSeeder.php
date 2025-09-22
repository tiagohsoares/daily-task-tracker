<?php

namespace Database\Seeders;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(30)->create(
            [
                'password' => 'password',
            ]
        );

        foreach ($users as $user) {
            $categories = Category::factory(10)->for($user)->create();

            foreach ($categories as $category) {
                Task::factory(30)->for($user)->for($category)->state(new Sequence(
                    fn () => [
                        'status'    => fake()->randomElement(TaskStatus::cases()),
                        'frequency' => fake()->randomElement(TaskFrequency::cases()),
                    ]
                ))->create();
            }
        }

        $user = User::factory()->
         create([
             'name'     => 'Test User',
             'email'    => env('USER_EMAIL', 'test@example.com'),
             'password' => env('USER_PASSWORD', 'password'),
         ]);

        Task::factory(30)->for($user)->state(new Sequence(
            fn () => [
                'user_id'   => $user->id,
                'status'    => fake()->randomElement(TaskStatus::cases()),
                'frequency' => fake()->randomElement(TaskFrequency::cases()),
            ]
        ))->create();
    }
}
