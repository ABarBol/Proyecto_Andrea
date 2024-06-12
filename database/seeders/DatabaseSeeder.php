<?php

namespace Database\Seeders;

use App\Models\UserGroup;
use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
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

        /**
         * Users
         */
        $user1 = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'laravel',
            'admin' => 1,
        ]);

        $user2 = User::factory()->create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => 'laravel',
            'admin' => 0,
        ]);

        $group = Group::factory()->create([
            'name' => 'Group',
        ]);

        $task = Task::factory()->create([
            'start' => now(),
            'name' => 'My frist Task',
            'description' => 'This is my first Task',
            'color' => 'red'
        ]);

        UserGroup::factory()->create([
            'user_id' => $user1->id,
            'group_id' => $group->id,
        ]);

        UserGroup::factory()->create([
            'user_id' => $user2->id,
            'group_id' => $group->id,
        ]);

        TaskUser::factory()->create([
            'user_id' => $user1->id,
            'task_id' => $task->id,
            'group_id' => $group->id,
        ]);

        TaskUser::factory()->create([
            'user_id' => $user2->id,
            'task_id' => $task->id,
            'group_id' => $group->id,
        ]);


        User::factory(90)->create();
        Group::factory(50)->create();
        Task::factory(50)->create();
        UserGroup::factory(20)->create();
        TaskUser::factory(20)->create();
    }
}
