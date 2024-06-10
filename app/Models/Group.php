<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//mutator
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Model grom groups table
 */
class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation between groups table and users table
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups');
    }

    /**
     * Returns groups with the first letter in upper case and stores them in lower case.
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
}
