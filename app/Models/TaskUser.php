<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model of the intermediate table tasks_users
 */
class TaskUser extends Model
{
    use HasFactory;

    protected $table = 'tasks_users';

    protected $fillable = ['user_id', 'task_id', 'group_id'];

    /** 
     * Return the users from a task_user element
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the task from a task_user element
     *
     * @return void
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Return the group from a task_user element
     *
     * @return void
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
