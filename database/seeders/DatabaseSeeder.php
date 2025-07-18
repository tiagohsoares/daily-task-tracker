<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Categories::factory(5)->create();

        User::factory(20)->create()->each(function($user){
        $categories = Categories::all();

        foreach ($categories as $category) {
            Task::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }
    });

        User::factory()->create([
            'name' => 'Test User',
            'email' => env('USER_EMAIL', 'test@example.com'),
            'password' => env('USER_PASSWORD', 'password')
        ]);

        
    }
}
