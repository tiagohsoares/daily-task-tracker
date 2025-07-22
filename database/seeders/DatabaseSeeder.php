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
        
        $user = User::factory()->create();

        $categories = Category::factory()->count(3)->for($user)->create();

        foreach($categories as $category){
            $task = Task::all();
            Task::factory()->count(10)->for($user)->for($categories)->state(new Sequence( 
                    fn () => [  'status' => fake()->randomElement(TaskStatus::cases()),
                                'frequency' => fake()->randomElement(TaskFrequency::cases())]
                ))->create();
            }

        User::factory()->create([
            'name' => 'Test User',
            'email' => env('USER_EMAIL', 'test@example.com'),
            'password' => env('USER_PASSWORD', 'password')
        ]);
    }
}
