<?php

namespace Database\Seeders;

use App\Models\UserGroup;
use App\Models\Group;
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

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'laravel',
            'admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => 'laravel',
            'admin' => 1,
        ]);
        User::factory(90)->create();
        Group::factory(50)->create();
        Task::factory(50)->create();
        UserGroup::factory(20)->create();
    }
}
