<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model from tasks table
 */
class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation between tasks and users table
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }
}
