<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//mutator
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Model from users table
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Returns users with the first letter in upper case and stores them in lower case.
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );
    }

    /**
     * Returns the user's groups
     *
     * @return void
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups');
    }

    /**
     * Returns the user's tasks
     *
     * @return void
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'tasks_users');
    }
}
