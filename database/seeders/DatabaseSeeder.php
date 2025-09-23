<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::connection()->disableQueryLog();
        User::factory(59)->create();

        $user = User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => '12345678',
        ]);

        Task::factory(10)->for($user)->create();
        Category::factory(5)->for($user)->create();
    }
}
