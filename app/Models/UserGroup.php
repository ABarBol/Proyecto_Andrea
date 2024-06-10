<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model of the intermediate table users_groups
 */
class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'users_groups';

    protected $fillable = ['user_id', 'group_id'];

    /**
     * Returns the user from a user_group element
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the group from a user_group element
     *
     * @return void
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
